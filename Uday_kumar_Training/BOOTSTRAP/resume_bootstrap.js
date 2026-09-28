// to find the max number among two numbers
let firstInput = document.getElementById('first-number');
let secondInput = document.getElementById('second-number');
let maxValue = document.getElementById('max-value');
let maxButton = document.getElementById('Find-max');
maxButton.addEventListener('click', function (event) {
	event.preventDefault();
	let num1 = Number(firstInput.value);
	let num2 = Number(secondInput.value);
	if (firstInput.value === '' || secondInput.value === '') {
		alert('Please enter both numbers');
		return;
	}
	if (num1 > num2) {
		maxValue.innerText = num1;
	} else if (num2 > num1) {
		maxValue.innerText = num2;
	} else {
		maxValue.innerText = 'Both are equal';
	}
});
// for the revers the entered string
let stringInput = document.getElementById('string-to-revers');
let reverseButton = document.getElementById('make-rev');
let reversedString = document.getElementById('reversed-string');
reverseButton.addEventListener('click', function (event) {
	event.preventDefault();
	let str = stringInput.value;
	if (str === '') {
		alert('Please enter a string');
		return;
	}
	let arr = str.split('');
	let i = 0;
	let j = arr.length - 1;
	while (i < j) {
		let temp = arr[i];
		arr[i] = arr[j];
		arr[j] = temp;
		i++;
		j--;
	}
	reversedString.innerText = arr.join('');
});
//For largetst words among the entered words
let stringsInput = document.getElementById('string-input');
let largestButton = document.getElementById('give-largest-string');
let largestValue = document.getElementById('large-value');
largestButton.addEventListener('click', function (event) {
	event.preventDefault();
	let str = stringsInput.value;
	if (str === '') {
		alert('Please enter comma separated strings');
		return;
	}
	let words = str.split(',');
	let largest = '';
	let maxLength = 0;
	words.forEach(function (word) {
		word = word.trim();

		if (word.length > maxLength) {
			maxLength = word.length;
			largest = word;
		}
	});
	largestValue.innerText = largest;
});

// for the cookie modal
document.addEventListener('DOMContentLoaded', function () {
	let userName = document.getElementById('user-name');
	let phoneNumber = document.getElementById('phone-number');
	let savedName = document.getElementById('savedName');
	let savedPhone = document.getElementById('savedPhone');
	let errorMsg = document.getElementById('errorMsg');
	let saveButton = document.getElementById('save-cookie');
	saveButton.addEventListener('click', function () {
		let name = userName.value.trim();
		let phone = phoneNumber.value.trim();
		if (name === '') {
			errorMsg.innerText = 'Please enter your name';
			return;
		}
		if (phone.length !== 10 || isNaN(phone)) {
			errorMsg.innerText = 'Please enter a valid 10 digit phone number';
			return;
		}
		errorMsg.innerText = '';
		savedName.innerText = name;
		savedPhone.innerText = phone;
		document.cookie =
			'name=' + encodeURIComponent(name) + '; max-age=86400; path=/';

		document.cookie =
			'phone=' + encodeURIComponent(phone) + '; max-age=86400; path=/';

		alert('Data saved successfully');
		let modalElement = document.getElementById('cookieModal');
		let modal = bootstrap.Modal.getInstance(modalElement);
		if (modal) {
			modal.hide();
		}
	});
	function loadCookies() {
		let cookies = document.cookie.split(';');
		let name = '';
		let phone = '';
		cookies.forEach(function (cookie) {
			let data = cookie.trim().split('=');
			if (data[0] === 'name') {
				name = decodeURIComponent(data[1]);
			}
			if (data[0] === 'phone') {
				phone = decodeURIComponent(data[1]);
			}
		});
		if (name !== '') {
			savedName.innerText = name;
			userName.value = name;
		} else {
			savedName.innerText = 'Not available';
		}
		if (phone !== '') {
			savedPhone.innerText = phone;
			phoneNumber.value = phone;
		} else {
			savedPhone.innerText = 'Not available';
		}
	}
	loadCookies();
});
let navLinks = document.querySelectorAll('.nav-tabs .nav-link');
navLinks.forEach(function (link) {
	link.addEventListener('click', function () {
		// remove active from all links
		navLinks.forEach(function (item) {
			item.classList.remove('active');
		});
		// add active only to clicked link
		this.classList.add('active');
	});
});
let technologies = [
	'Python',
	'Django',
	'React',
	'JavaScript',
	'jQuery',
	'HTML',
	'CSS',
	'MySQL',
	'FastAPI',
];
// Js content For Tost
const toastTrigger = document.getElementById('liveToastBtn');
const toastLiveExample = document.getElementById('liveToast');
if (toastTrigger) {
	const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
	toastTrigger.addEventListener('click', () => {
		toastBootstrap.show();
	});
}
// for footer alert msg to modal
$(document).ready(function () {
	$('#mypage-footer').hide();
	$('#mypage-footer').slideDown(10000, function () {
		let modalElement = document.getElementById('footerModal');
		let modal = bootstrap.Modal.getOrCreateInstance(modalElement);
		modal.show();
	});
	$('#string-input').autocomplete({
		source: technologies,
	});
});

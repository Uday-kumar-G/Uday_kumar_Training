// 1. FIND MAX VALUE

let firstInput = document.getElementById("first-input");
let secondInput = document.getElementById("second-input");
let maxValue = document.getElementById("max-value");
let maxButton = document.getElementById("submit-btn");

maxButton.addEventListener("click", function (event) {
    event.preventDefault();

    let num1 = Number(firstInput.value);
    let num2 = Number(secondInput.value);

    if (firstInput.value === "" || secondInput.value === "") {
        alert("Please enter both numbers");
        return;
    }
    if (num1 > num2) {
        maxValue.innerText = num1;
    } 
    else if (num2 > num1) {
        maxValue.innerText = num2;
    } 
    else {
        maxValue.innerText = "Both are equal";
    }
});

// 2. REVERSE STRING

let stringInput = document.getElementById("string-to-rev");
let reverseButton = document.getElementById("make-rev");
let reversedString = document.getElementById("reversed-str");

reverseButton.addEventListener("click", function (event) {
    event.preventDefault();

    let str = stringInput.value;

    if (str === "") {
        alert("Please enter a string");
        return;
    }

    let arr = str.split("");

    let i = 0;
    let j = arr.length - 1;

    while (i < j) {
        let temp = arr[i];
        arr[i] = arr[j];
        arr[j] = temp;

        i++;
        j--;
    }

    reversedString.innerText = arr.join("");
});


// 3. FIND LARGEST STRING

let stringsInput = document.getElementById("string-inp");
let largestButton = document.getElementById("give-larg");
let largestValue = document.getElementById("Large-value");

largestButton.addEventListener("click", function (event) {
    event.preventDefault();

    let str = stringsInput.value;

    if (str === "") {
        alert("Please enter comma separated strings");
        return;
    }

    let words = str.split(",");

    let largest = "";
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

// 4. SAVE COOKIE

let userName = document.getElementById("user-name");
let phoneNumber = document.getElementById("Phone-number");

let cookieName = document.getElementById("savedName");
let cookiePhone = document.getElementById("savedPhone");

let saveCookieButton = document.getElementById("save-cookie");


saveCookieButton.addEventListener("click", function (event) {
    event.preventDefault();

    let name = userName.value;
    let phone = phoneNumber.value;

    if (name === "") {
        alert("Please enter your name");
        return;
    }

    if (phone.length !== 10) {
        alert("Phone number should contain 10 digits");
        return;
    }

    document.cookie =
        "name=" + encodeURIComponent(name) +
        "; max-age=86400; path=/";

    document.cookie =
        "phone=" + encodeURIComponent(phone) +
        "; max-age=86400; path=/";

    cookieName.innerText = name;
    cookiePhone.innerText = phone;

    alert("Cookie saved successfully");
});



// 5. LOAD COOKIE AUTOMATICALLY

function loadCookies() {

    let cookies = document.cookie.split(";");

    cookies.forEach(function (cookie) {

        let parts = cookie.trim().split("=");

        let key = parts[0];
        let value = decodeURIComponent(parts[1] || "");

        if (key === "name") {

            userName.value = value;

            cookieName.innerText = value;
        }

        if (key === "phone") {

            phoneNumber.value = value;

            cookiePhone.innerText = value;
        }
    });
}


// Run when page loads
window.addEventListener("load", function () {
    loadCookies();
});
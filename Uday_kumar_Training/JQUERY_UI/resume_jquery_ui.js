// 1. FIND MAX VALUE

let firstInput = document.getElementById("fitst-input");
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
let phoneNumber = document.getElementById("Phone-num");

let cookieName = document.getElementById("cooki-name");
let cookiePhone = document.getElementById("cooki-Phone");

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


$(document).ready(function () {
    $("#tabs").tabs();

    $("#myDialog").dialog({
        autoOpen: false,
        modal: true,

        buttons: {
            "OK": function () {
                $(this).dialog("close");
            },

            "Cancel": function () {
                $(this).dialog("close");
            }
        }
    });

    $("#accordion").accordion({
        collapsible: true,
        heightStyle: "content"
    });
    $(".mypage-content").css({
        "background-color": "#FFFF88 ",
        "padding": "10px",
        "border-radius": "10px",
        "margin": "5px"
    });

    $(".page-header").css({
        "height": "10px",
        "font-size": "30px",
        "overflow": "hidden",
        "text-align": "center",
        "border": "2px solid #CC0000",
        "border-radius": "10px",
        "color": "#980202",
        "background-color": "#fbac3c"
    });

    $(".page-header").on("mouseenter", function () {
        $(this).css({
            "height": "140px",
            "text-align": "center"
        });
    });

    $(".page-header").on("mouseleave", function () {
        $(this).css("height", "20px");
    });
    $(".all-input").css({
        "border": "none",
        "padding": "10px",
        "border-radius": "10px"
    });
    $(".my-buttons").css({
        "padding": "10px",
        "font-size": "20px",
        "background-color": "lightgreen",
        "color": "brown",
        "border-radius": "10px"
    })
    $(".max-value,.reverse-string,.find-largest-str,.cookies,.pick-date").css({

        "padding": "10px",
        "margin": "10px",
        "border": "1px solid white",
        "border-radius": "10px",
        "background-color": "#e78142",
        "color":"#500d00"
    });
    $("#tab1,#tab2,#tab3,#tab4").css({
        "padding": "10px",
        "margin": "10px",
        "border": "1px solid white",
        "border-radius": "10px",
        "background-color": "#e78142",
        "font-size":"25px",
         "color":"#500d00"
    });
    $(".my-buttons").button({
        icon: "ui-icon-disk",
        "filter": "brightness(0) invert(1)"
    });

    $("#date-picker").attr("text", "date");
    $("#date-picker").datepicker({
        dateFormat: "dd/mm/yy"
    });
    $(".page-footer").before("<div><h2>Reference</h2><h3>1. <a href='https://www.w3schools.com/jquery/jquery_events.asp'>Refer here for the Jquery</a></h3></div>");

    $(".page-footer").css({
        "text-align": "center",
        "border": "2px solid #e08080",
        "border-radius": "10px",
        "padding": "20px",
        "font-size": "20px",
        "display": "flex",
        "justify-content": "space-between",
        "color": "#edebeb",
        "background-color": "#cf1f1f"
    })
    $(".page-footer").hide();
    $(".page-footer").slideDown(10000, function () {
        $("#myDialog").dialog("open");
    });
    $("#page-navbar").css({
        "background-color": "#FEF2A0",
        "margin-left": "30px"
    })
})


$(window).on("load", function () {
    loadCookies();
    alert("Page fully loaded");
});



//  $(".my-table").css({
//         "border": "2px solid #FF1A00",
//         "margin":"5px",
//         "color":"#CC0000",
//         "font-size":"20px"
//     })
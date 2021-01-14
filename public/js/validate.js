const form = document.querySelector("form");
const email = form.querySelector('input[name="email"]');
const confirmPassword = form.querySelector('input[name="confirmPassword"]');
const phoneNumber = form.querySelector('input[name="phoneNumber"]');
const flatNumber = form.querySelector('input[name="flatNumber"]');
const postcode = form.querySelector('input[name="postcode"]');
const bankAccountNumber = form.querySelector('input[name="bankAccountNumber"]');

function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function arePasswordsSame(password, confirmPassword) {
    return password === confirmPassword;
}

function isNumber(value) {
    value = parseInt(value);
    return typeof value === 'number' && isFinite(value);
}

function markValidation(element, condition) {
    !condition ? element.classList.add("no-valid") : element.classList.remove("no-valid");
}

email.addEventListener("keyup", () => setTimeout(() => markValidation(email, isEmail(email.value)), 1000));

confirmPassword.addEventListener("keyup", () => {
    setTimeout(() => {
        const condition = arePasswordsSame(confirmPassword.previousElementSibling.value, confirmPassword.value);
        markValidation(confirmPassword, condition);
    }, 1000);
});

phoneNumber.addEventListener("keyup", () => {
    setTimeout(() => {
        const number = isNumber(phoneNumber.value);
        markValidation(phoneNumber, number && (phoneNumber.value.length === 9))
    }, 1000);
});

flatNumber.addEventListener("keyup", () => setTimeout(() => markValidation(postcode, isNumber(flatNumber.value)), 1000));
postcode.addEventListener("keyup", () => setTimeout(() => markValidation(postcode, isNumber(postcode.value)), 1000));

bankAccountNumber.addEventListener("keyup", () => {
    setTimeout(() => {
        const number = isNumber(bankAccountNumber.value);
        markValidation(bankAccountNumber, number && (bankAccountNumber.value.length === 26))
    }, 1000);
});

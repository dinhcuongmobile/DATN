function moveToNext(current, nextFieldId) {
    current.value = current.value.replace(/[^0-9]/g, ''); // Chỉ cho phép số

    if (current.value.length > 1) {
        current.value = current.value.charAt(0); // Giữ lại ký tự đầu tiên nếu nhập nhiều hơn
    }

    if (current.value.length === 1) {
        document.getElementById(nextFieldId).focus();
    }
    combineOtp();
}

function moveToPrev(event, current, prevFieldId) {
    if (event.key === "Backspace" && current.value.length === 0) {
        document.getElementById(prevFieldId).focus();
    }
    combineOtp();
}

function lastInput(current) {
    current.value = current.value.replace(/[^0-9]/g, ''); // Chỉ cho phép số

    if (current.value.length > 1) {
        current.value = current.value.charAt(0); // Giữ lại ký tự đầu tiên nếu nhập nhiều hơn
    }
    combineOtp();
}

function combineOtp() {
    let otp = '';
    for (let i = 1; i <= 4; i++) {
        otp += document.getElementById('otp' + i).value;
    }
    document.getElementById('hidden-otp').value = otp;
}

const otpContainer=document.getElementById('otp-container');
if(otpContainer){
    otpContainer.addEventListener('paste', function(event) {
        const pasteData = event.clipboardData.getData('text');
        if (pasteData.length === 4 && /^\d{4}$/.test(pasteData)) {
            for (let i = 0; i < 4; i++) {
                document.getElementById('otp' + (i + 1)).value = pasteData[i];
            }
            combineOtp();
            document.getElementById('otp4').focus();
        }
        event.preventDefault();
    });
}


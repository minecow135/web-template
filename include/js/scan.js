function onScanSuccess(decodedText, decodedResult) {
    // handle the scanned code as you like, for example:
    console.log(`Code matched = ${decodedText}`, decodedResult);
    document.getElementById("outCode").value = decodedText;
    document.getElementById("inCode").value = decodedText;
}
  
function onScanFailure(error) {
    // handle scan failure, usually better to ignore and keep scanning.
    // for example:
    // console.warn(`Code scan error = ${error}`);
}
  
let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps: 10, qrbox: {width: 300, height: 300} },
    /* verbose= */ false
);

html5QrcodeScanner.render(onScanSuccess, onScanFailure);
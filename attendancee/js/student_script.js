function generateQRCode() {
    const studentId = document.getElementById('student_id').value;
    const qrcodeContainer = document.getElementById('qrcode');
    qrcodeContainer.innerHTML = '';
    new QRCode(qrcodeContainer, {
        text: studentId,
        width: 128,
        height: 128
    });

    const qrCanvas = qrcodeContainer.querySelector('canvas');
    const downloadLink = document.getElementById('downloadLink');
    downloadLink.href = qrCanvas.toDataURL('image/png');
}

function scanQRCode() {
    const qrInput = document.getElementById('qrInput');
    const reader = new Html5Qrcode("reader");

    reader.scanFile(qrInput.files[0], true)
        .then(decodedText => {
            fetch('../php/record_attendance.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ student_id: decodedText })
            })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('result').innerText = data;
                });
        })
        .catch(err => {
            console.log('Error scanning file. Reason: ', err);
        });
}

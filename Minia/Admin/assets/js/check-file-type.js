
    document.getElementById('fileToUpload').addEventListener('change', function() {
        const files = this.files;
        const allowedExtensions = /(\.csv|\.xlsx)$/i;
        const validFiles = [];
        
        for (let i = 0; i < files.length; i++) {
            if (allowedExtensions.exec(files[i].name)) {
                validFiles.push(files[i]);
            }
        }
        if (validFiles.length === 0) {
            alert('Please select valid CSV or XLSX files.');
            this.value = '';
            return false;
        }
        // Now, 'validFiles' contains only the selected CSV and XLSX files
        console.log(validFiles);
    });


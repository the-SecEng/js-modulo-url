// Module containing password-related functionality
const PasswordModule = (() => {
    // Private function to check if passwords match
    const passwordsMatch = () => {
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('passwordConfirmation').value;

        return password === passwordConfirmation;
    };

    // Public method to expose the passwordsMatch functionality
    const publicPasswordsMatch = () => passwordsMatch();

    // Public interface
    return {
        passwordsMatch: publicPasswordsMatch,
    };
})();

// Module containing URL-related functionality
const UrlModule = (() => {
    // Private function to get URL parameters
    const getParameterByName = (name, url) => {
        if (!url) url = window.location.href;

        const segments = url.split("/");
        const lastSegment = segments[segments.length - 1];

        // Check if the last segment matches the expected UUID format
        const uuidRegex = /^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/;

        if (uuidRegex.test(lastSegment)) {
            return lastSegment;
        } else {
            // URL doesn't match the expected format
            return null;
        }
    };

    // Public method to expose the getParameterByName functionality
    const publicGetParameterByName = (name, url) => getParameterByName(name, url);

    // Public interface
    return {
        getParameterByName: publicGetParameterByName,
    };
})();


// Module containing form submission functionality
const SubmissionModule = (() => {
    // Private function to submit the form
    const submitForm = (uuid, password) => {
        try {
            // Validate UUID and password
            if (!uuid || !password) {
                throw new Error('UUID and password are required');
            }

            // Create data object
            const data = {
                "uuid": uuid,
                "password": password
            };

            // Make a POST request
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://127.0.0.1:8000/api/new/user', true);
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.send(JSON.stringify(data));

            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4) {
                    // Handle the response here
                    if (xhr.status === 200) {
                        console.log('Success:', xhr.responseText);
                    } else {
                        console.error('Error:', xhr.statusText);
                    }
                }
            };
        } catch (error) {
            console.error('An error occurred:', error.message);
        }
    };

    // Public method to expose the submitForm functionality
    const publicSubmitForm = () => {
        const uuid = UrlModule.getParameterByName('uuid');
        // const uuid = window.location.href
        const password = document.getElementById('password').value;

        submitForm(uuid, password);
        console.log("DEBUG: UUID", uuid, "DEBUG: PASS", password);
    };

    // Public interface
    return {
        submitForm: publicSubmitForm,
    };
})();

document.getElementById('botonConfirmar').addEventListener('click', () => {
    if (PasswordModule.passwordsMatch()) {
        SubmissionModule.submitForm();
    } else {
        // Display error message for password mismatch
        document.getElementById('passwordError').style.display = 'block';
    }
});

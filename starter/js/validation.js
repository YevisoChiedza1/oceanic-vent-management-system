document.getElementById('contactForm').addEventListener('submit', function(event) {
    let isValid = true;

    // Grab elements
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const comment = document.getElementById('comment');

    // Reset error messages
    document.querySelectorAll('.error').forEach(el => el.textContent = "");

    // Validate Name
    if (name.value.trim() === "") {
        document.getElementById('nameError').textContent = "Name is required.";
        isValid = false;
    }

    // Validate Email
    if (email.value.trim() === "" || !email.value.includes('@')) {
        document.getElementById('emailError').textContent = "A valid email is required.";
        isValid = false;
    }

    // Validate Comment
    if (comment.value.trim() === "") {
        document.getElementById('commentError').textContent = "Please enter a message.";
        isValid = false;
    }

    // If not valid, stop the form from submitting
    if (!isValid) {
        event.preventDefault();
    }
});
const form = document.getElementById('loginForm');
form.addEventListener('submit', (event) => {
	event.preventDefault();
	const username = document.getElementById('username').value;
	const password = document.getElementById('password').value;
	if (username === 'myusername' && password === 'mypassword') {
		alert('Login Successful!');
		//redirect to another page
		window.location.href = 'http://www.example.com';
	} else {
		alert('Invalid Credentials! Please try again.');
	}
});
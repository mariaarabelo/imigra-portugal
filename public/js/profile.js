//------------------------------------------------------------- Edit profile
function showEmailInput() {
    const emailDisplay = document.getElementById('email-display');
    const emailInput = document.getElementById('email-input');
    const editEmailIcon = document.querySelector('#edit-email i');
    const saveEmailButton = document.getElementById('save-email');
  
    // Toggle display of email input and edit icon
    emailDisplay.style.display = 'none';
    emailInput.style.display = 'block';
    editEmailIcon.style.visibility = 'hidden';
    saveEmailButton.style.display = 'block';
  }
  
  function hideEmailInput() {
    const emailDisplay = document.getElementById('email-display');
    const emailInput = document.getElementById('email-input');
    const editEmailIcon = document.querySelector('#edit-email i');
    const saveEmailButton = document.getElementById('save-email');
  
    // Toggle display of email input and edit icon
    emailDisplay.style.display = 'inline';
    emailInput.style.display = 'none';
    editEmailIcon.style.visibility = 'visible';
    saveEmailButton.style.display = 'none';
  }
  
  
  function saveEmail(userId) {
  
    const newEmail = document.getElementById('email-input').value;
    var url = `/profiles/updateEmail/${userId}`;
  
    fetch(url, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({email: newEmail}),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); 
    })
    .then(response => {
        // Handle the updated data
        console.log(response);
        // Update your page with the new data
        document.getElementById('email-display').textContent = response.email;
        hideEmailInput();
      })
    .catch(error => {
        // Handle errors here
        console.error('Fetch error:', error);
        alert('Email update failed. Please try again.');
    });
  
  }

function showPassInput() {
    var passwordInputs = document.getElementById('password-inputs');
    passwordInputs.style.display = 'block';
}

function savePass(userId) {
    const oldPassword = document.getElementById('old-pass').value;
    const newPassword = document.getElementById('new-pass').value;
    const newPasswordConfirm = document.getElementById('new-pass-confirm').value;

    var url = `/profiles/updatePass/${userId}`;
    
    console.log('User ID:', userId);
    console.log('Old Password:', oldPassword);
    console.log('New Password:', newPassword);
    console.log('Confirm New Password:', newPasswordConfirm);
  
    fetch(url, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            oldPassword: oldPassword,
            newPassword: newPassword,
            newPasswordConfirm: newPasswordConfirm
        }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json(); 
    })
    .then(response => {
        // Check the response for success or error messages
        if (response.success) {
            console.log('Password updated successfully');
            // Handle success if needed
        } else {
            console.error('Password update failed:', response.error);
            alert('Password update failed. Try again.');
        }
      })
    .catch(error => {
        // Handle errors here
        console.error('Fetch error:', error);
    })
    .finally(() => {
        // Reset the input fields and hide them
        document.getElementById('old-pass').value = '';
        document.getElementById('new-pass').value = '';
        document.getElementById('new-pass-confirm').value = '';
        document.getElementById('password-inputs').style.display = 'none';
    });; 
}

oldPwdView = document.getElementById('oldPwdView');
oldPwdView.addEventListener('change', toggleOldPwdView);

function toggleOldPwdView() {
    var x = document.getElementById("oldPwd");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
}

newPwdView = document.getElementById('newPwdView');
newPwdView.addEventListener('change', toggleNewPwdView);

function toggleNewPwdView() {
    var x = document.getElementById("newPwd");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
}

document.getElementById('changePwd').addEventListener('change', function () {
  var pwdChanger = document.getElementById('pwdChanger');
  if (this.checked) {
    pwdChanger.style.display = 'block';
  } else {
    pwdChanger.style.display = 'none';
  }
});

document.getElementById('submit').addEventListener('click', function () {
  console.log("Submit button clicked!");
  // Gather updated information from the form fields
  var updatedData = {
    firstName: document.getElementById('firstName').value,
    lastName: document.getElementById('lastName').value,
    email: document.getElementById('email').value,
    phone: document.getElementById('phone').value,
    optInPromo: document.getElementById('optInPromo').checked ? 1 : 0,
    street: document.getElementById('shipAddress').value,
    city: document.getElementById('shipCity').value,
    state: document.getElementById('shipState').value,
    country: document.getElementById('shipCountry').value,
    zipCode: document.getElementById('shipZip').value,
    cardType1: document.querySelector('input[name="creDeb1"]:checked').value,
    cardNumber1: document.getElementById('cardNum1').value,
    expirationDate1: document.getElementById('exp1').value,
    billingStreet1: document.getElementById('billAdd1').value,
    billingCountry1: document.getElementById('billAddCtry1').value,
    billingZipCode1: document.getElementById('billAddZip1').value,
    billingCity1: document.getElementById('billAddCity1').value,
    billingState1: document.getElementById('billAddState1').value,
    cardType2: document.querySelector('input[name="creDeb2"]:checked').value,
    cardNumber2: document.getElementById('cardNum2').value,
    expirationDate2: document.getElementById('exp2').value,
    billingStreet2: document.getElementById('billAdd2').value,
    billingCountry2: document.getElementById('billAddCtry2').value,
    billingZipCode2: document.getElementById('billAddZip2').value,
    billingCity2: document.getElementById('billAddCity2').value,
    billingState2: document.getElementById('billAddState2').value,
    cardType3: document.querySelector('input[name="creDeb3"]:checked').value,
    cardNumber3: document.getElementById('cardNum3').value,
    expirationDate3: document.getElementById('exp3').value,
    billingStreet3: document.getElementById('billAdd3').value,
    billingCountry3: document.getElementById('billAddCtry3').value,
    billingZipCode3: document.getElementById('billAddZip3').value,
    billingCity3: document.getElementById('billAddCity3').value,
    billingState3: document.getElementById('billAddState3').value,
    oldPassword: document.getElementById('changePwd').checked ? document.getElementById('oldPwd').value : "",
    newPassword: document.getElementById('changePwd').checked ? document.getElementById('newPwd').value : ""
  };

  console.log("Sending data:", updatedData);

  // Send updated data to the server using AJAX
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'updateProfile.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    console.log("Response received:", xhr.responseText);
    if (xhr.status === 200) {
      // Parse JSON response from server
      var response = JSON.parse(xhr.responseText);
      console.log("Parsed response:", response);
      if (response.success) {
        // Profile updated successfully
        alert('Profile updated successfully.');
        window.location.reload(); // Reload the page to reflect changes
      } else {
        // Failed to update profile
        alert('Failed to update profile. Error: ' + response.error);
      }
    } else {
      // Handle error response from the server
      console.error('Error: ' + xhr.statusText);
    }
  };
  // Convert data object to URL-encoded form data
  var formData = Object.keys(updatedData).map(function (key) {
    return encodeURIComponent(key) + '=' + encodeURIComponent(updatedData[key]);
  }).join('&');
  console.log("Sending formData:", formData);
  xhr.send(formData);
});

pwdView1 = document.getElementById('pwdView1');

function togglePwdView1() {
    var x = document.getElementById("createPwd");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

pwdView1.addEventListener('change', togglePwdView1);
function moveSubmitButtonToBottom() {
    const form = document.getElementById('creAcc');
    const submitButton = document.getElementById('submit');
    if (form.contains(submitButton)) {
        form.appendChild(submitButton);
    }
}
card1 = document.getElementById('card1');

function toggleCard1() {
    const form = document.getElementById('creAcc');
    if (card1.checked) {

      br = document.createElement('br');
      br2 = document.createElement('br');
  
      credit1 = document.createElement('input');
      credit1.type = 'radio';
      credit1.value = 'credit';
      credit1.name = 'creDeb1';
      credit1.id = 'credit1';
  
      credit1Label = document.createElement('label');
      credit1Label.textContent = 'credit';
      credit1Label.for = 'credit1';
      
      debit1 = document.createElement('input');
      debit1.type = 'radio';
      debit1.value = 'debit';
      debit1.name = 'creDeb1';
      debit1.id = 'debit1';
  
      debit1Label = document.createElement('label');
      debit1Label.textContent = 'debit';
      debit1Label.for = 'debit1';
  
      creditHolder1 = document.createElement('li');
      creditHolder1.appendChild(credit1);
      creditHolder1.appendChild(credit1Label);
      debitHolder1 = document.createElement('li');
      debitHolder1.appendChild(debit1);
      debitHolder1.appendChild(debit1Label);
      creDebHolder1 = document.createElement('ul');
      creDebHolder1.appendChild(creditHolder1);
      creDebHolder1.appendChild(debitHolder1);
  
      cardHolder1 = document.createElement('div');
      cardHolder1.id = 'cardHolder';
      cardHolder1.class = 'card';

      credit1Label.style.marginRight = '50px'; // to give space between Credit and Debit
      creditHolder1.appendChild(document.createElement('br')); // to give space 
  
      numLabel1 = document.createElement('label');
      numLabel1.textContent = 'Card Number: ';
  
      cardNum1 = document.createElement('input');
      cardNum1.type = 'tel';
      cardNum1.maxlength = '19';
      cardNum1.placeholder = '0000 1111 2222 3333';
      cardNum1.id = 'cardNum1';
  
      expLabel1 = document.createElement('label');
      expLabel1.textContent = 'Expiration Date: ';
  
      expiration1 = document.createElement('input');
      expiration1.type = 'tel';
      expiration1.placeholder = "MM / YY";
      expiration1.id = 'exp1';
  
      billAddDiv1 = document.createElement('div');
  
      billAddLabel1 = document.createElement('label');
      billAddLabel1.textContent = 'Billing Address: ';
  
      billAddL1 = document.createElement('label');
      billAddL1.textContent = 'Address';
      billAddL1.class = 'billing1';
      billAddL1.for = 'billAdd1';
  
      billAdd1 = document.createElement('input');
      billAdd1.type = 'text';
      billAdd1.id = 'billAdd1';
      billAdd1.placeholder = '1234 pinetree lane';
  
      billAddCtryL1 = document.createElement('label');
      billAddCtryL1.textContent = 'Country';
      billAddCtryL1.class = 'billing1';
      billAddCtryL1.for = 'billAddCtry1';
  
      billAddCtry1 = document.createElement('input');
      billAddCtry1.type = 'text';
      billAddCtry1.id = 'billAddCtry1';
      billAddCtry1.placeholder = 'United States';
  
      billAddZipL1 = document.createElement('label');
      billAddZipL1.textContent = 'Zipcode';
      billAddZipL1.class = 'billing1';
      billAddZipL1.for = 'billAddZip1';
  
      billAddZip1 = document.createElement('input');
      billAddZip1.type = 'tel';
      billAddZip1.id = 'billAddZip1';
      billAddZip1.placeholder = '40078';
  
      billAddCityL1 = document.createElement('label');
      billAddCityL1.textContent = 'City';
      billAddCityL1.class = 'billing1';
      billAddCityL1.for = 'billAddCity1';
  
      billAddCity1 = document.createElement('input');
      billAddCity1.type = 'text';
      billAddCity1.id = 'billAddCity1';
      billAddCity1.placeholder = 'Athens';
  
      billAddStateL1 = document.createElement('label');
      billAddStateL1.textContent = 'State';
      billAddStateL1.class = 'billing1';
      billAddStateL1.for = 'billAddState1';
  
      billAddState1 = document.createElement('input');
      billAddState1.type = 'text';
      billAddState1.id = 'billAddState1';
      billAddState1.placeholder = 'Georgia';

      billAddDiv1.appendChild(document.createElement('br')); // to give space between MM/YY and Billing Address
      billAddDiv1.appendChild(billAddLabel1);
      billAddDiv1.appendChild(br);
      billAddDiv1.appendChild(billAddL1);
      billAddDiv1.appendChild(billAdd1);
      billAddDiv1.appendChild(billAddCtryL1);
      billAddDiv1.appendChild(billAddCtry1);
      billAddDiv1.appendChild(billAddZipL1);
      billAddDiv1.appendChild(billAddZip1);
      billAddDiv1.appendChild(billAddCityL1);
      billAddDiv1.appendChild(billAddCity1);
      billAddDiv1.appendChild(billAddStateL1);
      billAddDiv1.appendChild(billAddState1);
  
      card2 = document.createElement('input');
      card2.type = 'checkbox';
      card2.id = 'card2';
  
      card2.addEventListener('change', toggleCard2);
  
  
      card2Label = document.createElement('label');
      card2Label.textContent = 'Add Second Card';
      card2Label.for = 'card2';
  
      card2Div = document.createElement('div');
      card2Div.appendChild(card2);
      card2Div.appendChild(card2Label);
  
  
  
      cardHolder1.appendChild(creDebHolder1);
      cardHolder1.appendChild(numLabel1);
      cardHolder1.appendChild(cardNum1);
      cardHolder1.appendChild(expLabel1);
      cardHolder1.appendChild(expiration1);
      cardHolder1.appendChild(billAddDiv1);
      cardHolder1.appendChild(card2Div);
  
        form.appendChild(cardHolder1);
        moveSubmitButtonToBottom();
    } else {
        form.removeChild(cardHolder1);
        form.removeChild(cardHolder2);
        form.removeChild(cardHolder3);
        moveSubmitButtonToBottom();
    }
}

function toggleCard2() {
    const form = document.getElementById('creAcc');
    if (card2.checked) {
      credit2 = document.createElement('input');
      credit2.type = 'radio';
      credit2.value = 'credit';
      credit2.name = 'creDeb2';
      credit2.id = 'credit2';
  
      credit2Label = document.createElement('label');
      credit2Label.textContent = 'credit';
      credit2Label.for = 'credit2';
      
      debit2 = document.createElement('input');
      debit2.type = 'radio';
      debit2.value = 'debit';
      debit2.name = 'creDeb2';
      debit2.id = 'debit2';
  
      debit2Label = document.createElement('label');
      debit2Label.textContent = 'debit';
      debit2Label.for = 'debit2';
  
      creditHolder2 = document.createElement('li');
      creditHolder2.appendChild(credit2);
      creditHolder2.appendChild(credit2Label);
      debitHolder2 = document.createElement('li');
      debitHolder2.appendChild(debit2);
      debitHolder2.appendChild(debit2Label);
      creDebHolder2 = document.createElement('ul');
      creDebHolder2.appendChild(creditHolder2);
      creDebHolder2.appendChild(debitHolder2);
  
      cardHolder2 = document.createElement('div');
      cardHolder2.id = 'cardHolder';
      cardHolder2.class = 'card';

      credit2Label.style.marginRight = '50px'; // to give space between Credit and Debit
      creditHolder2.appendChild(document.createElement('br')); // to give space 
  
      numLabel2 = document.createElement('label');
      numLabel2.textContent = 'Card Number: ';
  
      cardNum2 = document.createElement('input');
      cardNum2.type = 'tel';
      cardNum2.maxlength = '19';
      cardNum2.placeholder = '0000 1111 2222 3333';
      cardNum2.id = 'cardNum2';
  
      expLabel2 = document.createElement('label');
      expLabel2.textContent = 'Expiration Date: ';
  
      expiration2 = document.createElement('input');
      expiration2.type = 'tel';
      expiration2.placeholder = "MM / YY";
      expiration2.id = 'exp2';
  
      billAddDiv2 = document.createElement('div');
  
      billAddLabel2 = document.createElement('label');
      billAddLabel2.textContent = 'Billing Address: ';
  
      billAddL2 = document.createElement('label');
      billAddL2.textContent = 'Address';
      billAddL2.class = 'billing2';
      billAddL2.for = 'billAdd2';
  
      billAdd2 = document.createElement('input');
      billAdd2.type = 'text';
      billAdd2.id = 'billAdd2';
      billAdd2.placeholder = '1234 pinetree lane';
  
      billAddCtryL2 = document.createElement('label');
      billAddCtryL2.textContent = 'Country';
      billAddCtryL2.class = 'billing2';
      billAddCtryL2.for = 'billAddCtry2';
  
      billAddCtry2 = document.createElement('input');
      billAddCtry2.type = 'text';
      billAddCtry2.id = 'billAddCtry2';
      billAddCtry2.placeholder = 'United States';
  
      billAddZipL2 = document.createElement('label');
      billAddZipL2.textContent = 'Zipcode';
      billAddZipL2.class = 'billing2';
      billAddZipL2.for = 'billAddZip2';
  
      billAddZip2 = document.createElement('input');
      billAddZip2.type = 'tel';
      billAddZip2.id = 'billAddZip2';
      billAddZip2.placeholder = '40078';
  
      billAddCityL2 = document.createElement('label');
      billAddCityL2.textContent = 'City';
      billAddCityL2.class = 'billing2';
      billAddCityL2.for = 'billAddCity2';
  
      billAddCity2 = document.createElement('input');
      billAddCity2.type = 'text';
      billAddCity2.id = 'billAddCity2';
      billAddCity2.placeholder = 'Athens';
  
      billAddStateL2 = document.createElement('label');
      billAddStateL2.textContent = 'State';
      billAddStateL2.class = 'billing2';
      billAddStateL2.for = 'billAddState2';
  
      billAddState2 = document.createElement('input');
      billAddState2.type = 'text';
      billAddState2.id = 'billAddState2';
      billAddState2.placeholder = 'Georgia';

      billAddDiv2.appendChild(document.createElement('br')); // to give space between MM/YY and Billing Address
      billAddDiv2.appendChild(billAddLabel2);
      billAddDiv2.appendChild(billAddLabel2);
      billAddDiv2.appendChild(br);
      billAddDiv2.appendChild(billAddL2);
      billAddDiv2.appendChild(billAdd2);
      billAddDiv2.appendChild(billAddCtryL2);
      billAddDiv2.appendChild(billAddCtry2);
      billAddDiv2.appendChild(billAddZipL2);
      billAddDiv2.appendChild(billAddZip2);
      billAddDiv2.appendChild(billAddCityL2);
      billAddDiv2.appendChild(billAddCity2);
      billAddDiv2.appendChild(billAddStateL2);
      billAddDiv2.appendChild(billAddState2);
  
  
      card3 = document.createElement('input');
      card3.type = 'checkbox';
      card3.id = 'card3';
  
      card3.addEventListener('change', toggleCard3);
  
      card3Label = document.createElement('label');
      card3Label.textContent = 'Add Third Card';
      card3Label.for = 'card3';
  
      card3Div = document.createElement('div');
      card3Div.appendChild(card3);
      card3Div.appendChild(card3Label);
  
  
  
  
      cardHolder2.appendChild(creDebHolder2);
      cardHolder2.appendChild(numLabel2);
      cardHolder2.appendChild(cardNum2);
      cardHolder2.appendChild(expLabel2);
      cardHolder2.appendChild(expiration2);
      cardHolder2.appendChild(billAddDiv2);
      cardHolder2.appendChild(card3Div);
        form.appendChild(cardHolder2);
        moveSubmitButtonToBottom();
    } else {
        form.removeChild(cardHolder2);
        form.removeChild(cardHolder3);
        moveSubmitButtonToBottom();
    }
}

function toggleCard3() {
    const form = document.getElementById('creAcc');
    if (card3.checked) {

      credit3 = document.createElement('input');
      credit3.type = 'radio';
      credit3.value = 'credit';
      credit3.name = 'creDeb3';
      credit3.id = 'credit3';
  
      credit3Label = document.createElement('label');
      credit3Label.textContent = 'credit';
      credit3Label.for = 'credit3';
      
      debit3 = document.createElement('input');
      debit3.type = 'radio';
      debit3.value = 'debit';
      debit3.name = 'creDeb3';
      debit3.id = 'debit3';
  
      debit3Label = document.createElement('label');
      debit3Label.textContent = 'debit';
      debit3Label.for = 'debit3';
  
      creditHolder3 = document.createElement('li');
      creditHolder3.appendChild(credit3);
      creditHolder3.appendChild(credit3Label);
      debitHolder3 = document.createElement('li');
      debitHolder3.appendChild(debit3);
      debitHolder3.appendChild(debit3Label);
      creDebHolder3 = document.createElement('ul');
      creDebHolder3.appendChild(creditHolder3);
      creDebHolder3.appendChild(debitHolder3);
  
      cardHolder3 = document.createElement('div');
      cardHolder3.id = 'cardHolder';
      cardHolder3.class = 'card';

      credit3Label.style.marginRight = '50px'; // to give space between Credit and Debit
      creditHolder3.appendChild(document.createElement('br')); // to give space 
  
      numLabel3 = document.createElement('label');
      numLabel3.textContent = 'Card Number: ';
  
      cardNum3 = document.createElement('input');
      cardNum3.type = 'tel';
      cardNum3.maxlength = '19';
      cardNum3.placeholder = '0000 1111 2222 3333';
      cardNum3.id = 'cardNum3';
  
      expLabel3 = document.createElement('label');
      expLabel3.textContent = 'Expiration Date: ';
  
      expiration3 = document.createElement('input');
      expiration3.type = 'tel';
      expiration3.placeholder = "MM / YY";
      expiration3.id = 'exp3';
  
      billAddDiv3 = document.createElement('div');
  
      billAddLabel3 = document.createElement('label');
      billAddLabel3.textContent = 'Billing Address: ';
  
      billAddL3 = document.createElement('label');
      billAddL3.textContent = 'Address';
      billAddL3.class = 'billing3';
      billAddL3.for = 'billAdd3';
  
      billAdd3 = document.createElement('input');
      billAdd3.type = 'text';
      billAdd3.id = 'billAdd3';
      billAdd3.placeholder = '1234 pinetree lane';
  
      billAddCtryL3 = document.createElement('label');
      billAddCtryL3.textContent = 'Country';
      billAddCtryL3.class = 'billing3';
      billAddCtryL3.for = 'billAddCtry3';
  
      billAddCtry3 = document.createElement('input');
      billAddCtry3.type = 'text';
      billAddCtry3.id = 'billAddCtry3';
      billAddCtry3.placeholder = 'United States';
  
      billAddZipL3 = document.createElement('label');
      billAddZipL3.textContent = 'Zipcode';
      billAddZipL3.class = 'billing3';
      billAddZipL3.for = 'billAddZip3';
  
      billAddZip3 = document.createElement('input');
      billAddZip3.type = 'tel';
      billAddZip3.id = 'billAddZip3';
      billAddZip3.placeholder = '40078';
  
      billAddCityL3 = document.createElement('label');
      billAddCityL3.textContent = 'City';
      billAddCityL3.class = 'billing3';
      billAddCityL3.for = 'billAddCity3';
  
      billAddCity3 = document.createElement('input');
      billAddCity3.type = 'text';
      billAddCity3.id = 'billAddCity3';
      billAddCity3.placeholder = 'Athens';
  
      billAddStateL3 = document.createElement('label');
      billAddStateL3.textContent = 'State';
      billAddStateL3.class = 'billing3';
      billAddStateL3.for = 'billAddState3';
  
      billAddState3 = document.createElement('input');
      billAddState3.type = 'text';
      billAddState3.id = 'billAddState3';
      billAddState3.placeholder = 'Georgia';

      billAddDiv3.appendChild(document.createElement('br')); // to give space between MM/YY and Billing Address
      billAddDiv3.appendChild(billAddLabel3);
      billAddDiv3.appendChild(br);
      billAddDiv3.appendChild(billAddL3);
      billAddDiv3.appendChild(billAdd3);
      billAddDiv3.appendChild(billAddCtryL3);
      billAddDiv3.appendChild(billAddCtry3);
      billAddDiv3.appendChild(billAddZipL3);
      billAddDiv3.appendChild(billAddZip3);
      billAddDiv3.appendChild(billAddCityL3);
      billAddDiv3.appendChild(billAddCity3);
      billAddDiv3.appendChild(billAddStateL3);
      billAddDiv3.appendChild(billAddState3);
  
      cardHolder3.appendChild(creDebHolder3);
      cardHolder3.appendChild(numLabel3);
      cardHolder3.appendChild(cardNum3);
      cardHolder3.appendChild(expLabel3);
      cardHolder3.appendChild(expiration3);
      cardHolder3.appendChild(billAddDiv3);
  
        form.appendChild(cardHolder3);
        moveSubmitButtonToBottom();
    } else {
        form.removeChild(cardHolder3);
        moveSubmitButtonToBottom();
    }
}

card1.addEventListener('change', toggleCard1);
card2.addEventListener('change', toggleCard2);
card3.addEventListener('change', toggleCard3);

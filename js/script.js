const checkbox = document.querySelectorAll('.tax_trfal');
const dropdown = document.querySelectorAll('.tax_drop');
const btn = document.querySelectorAll('.tax_btn')[0];

checkbox.forEach((input) => {
	input.addEventListener("change", (e) => {
		const ischeck = checkbox[0].checked;
		if(!ischeck){
			btn.style.display="none";
			dropdown[0].style.display="none";
		}else{
			btn.style.display="inline-block";
			dropdown[0].style.display="inline-block";
		}
	});
});

dropdown.forEach((input) => {
	input.addEventListener("change", (e) => {
//		const value = dropdown[0].value;
		btn.attributes[1].value = 'test';
	});
});
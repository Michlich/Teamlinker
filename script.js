document.getElementById('searchTeam').addEventListener('click', function(event) {
	event.preventDefault(); 
	var popup = document.getElementById('teamPopup');
	popup.classList.toggle('show');
});

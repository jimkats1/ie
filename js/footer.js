function footer()
{
	now=new Date();
	year=now.getFullYear(); 
	document.getElementById('footer').innerHTML='<p><a class="link" href="http://www.teimes.gr">ΤΕΙ Μεσολογγίου</a> | <a class="link" href="http://www.tesyd.teimes.gr">Τμήμα Τηλεπικοινωνιακών Συστημάτων και Δικτύων(ΤΕΣΥΔ)</a> | &copy; '+year+'</p>';
	document.getElementById('footer').innerHTML+='<p class="copyright">Ανάπτυξη-Σχεδιασμός: Γιώργος Λεμάνης</p>'
}

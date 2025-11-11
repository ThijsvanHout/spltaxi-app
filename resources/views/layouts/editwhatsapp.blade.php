<style>
    .whatsapp-container {
        max-width: 700px;
        margin: 30px auto;
        background: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px 25px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }
    .whatsapp-header {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .whatsapp-phone {
        color: #25D366;
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 15px;
    }
    textarea {
        width: 100%;
        border-radius: 6px;
        padding: 10px;
        font-size: 14px;
        line-height: 1.4;
        border: 1px solid #ccc;
        resize: vertical;
    }
    button {
        background-color: #25D366;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 15px;
        cursor: pointer;
        margin-top: 15px;
    }
    button:hover {
        background-color: #1EBE5D;
    }
</style>

<div class="whatsapp-container">
	<form method="get" action="{{ route('whatsapp.send') }}">
		<div class="whatsapp-header">WhatsApp Bericht voor chauffeur</div>
		<!-- Bewerkbaar telefoonnummer -->
		<label>Telefoonnummer chauffeur:</label>
		<input type="text" name="phone" value="{{ $phone }}" placeholder="Telefoonnummer">>

        <textarea name="message" rows="25">{{ $displayMessage }}</textarea><br>
        <button type="submit">Verstuur via WhatsApp</button>
    </form>	
</div>


<script >
	function sendWhatsAppMessage(e) {
		e.preventDefault();
		let message = document.getElementById('message').value;
		let phone = document.getElementById('phone').value;
		// \r\n omzetten naar \n voor WhatsApp
		message = message.replace(/\r\n/g, "\n");
		const url = "https://api.whatsapp.com/send?phone=" + encodeURIComponent(phone) + "&text=" + encodeURIComponent(message);
		window.open(url, "_blank");
</script>

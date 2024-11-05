<!DOCTYPE html>
<html lang="en">

<head>
    <title>Win Htike Chat</title>
    <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- JavaScript -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- End JavaScript -->

</head>

<body>
    <h1>Pusher Messages Here</h1>
    <div id="messages">
    </div>
    <div class="message-input">
        <form id="messageForm" action="{{ route('push-message') }}" method="POST">
            @csrf
            <input autocomplete="off" type="text" id="text" name="text" id="messageInput"
                placeholder="Type your message...">

            <button type="submit">Send</button>

        </form>
    </div>
</body>

<script>
    messages = document.getElementById("messages");
    const pusher = new Pusher('8e358f120d4aeaadad01', {
        cluster: 'ap1'
    });
    const channel = pusher.subscribe('my-channel');

    //Receive messages
    channel.bind('my-event', function(data) {
        console.log(data)
        // alert(data.message)
        messages.innerHTML += data.message + "<br />"

    });
</script>

<script>
    $("#messageForm").submit(e => {
        e.preventDefault();

        let text = $("#text").val().trim();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "/push-message",
            type: 'POST',
            data: {
                text,
                _token
            },
            success: response => {
                console.log(response);
                $("#messageForm")[0].reset();
            }
        })
    });
</script>

</html>

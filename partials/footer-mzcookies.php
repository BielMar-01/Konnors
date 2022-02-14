<div id="mzCookieBar">
    <div class="container">
        <span class="cookiesTerm"><?php the_field("cookiesTerm", "options"); ?></span>
        <button class="accept"><?php the_field("cookiesAcceptText", "options"); ?></button>
    </div>
</div>

<script id="mz_cookie_management">
    (function(){
        const cookieName = "mzlovecookies";
        const cookiesDurationHours = 24;

        const ACCEPTED = "accepted";

        function hasCookie(cookieName) {
            const cookies = document.cookie.split("; ");
            return cookies.indexOf(cookieName +"="+ ACCEPTED) === -1 ? false : true;
        }

        function expires() {
            return new Date(new Date().setHours(new Date().getHours() + cookiesDurationHours)).toUTCString();
        }

        function setCookie(name, value, path, expires) {
            const expiresParamenter = expires ? "expires="+expires : '';
            document.cookie = name + "=" + value + ";path=" + path + ";" + expiresParamenter;
        }

        if(!hasCookie(cookieName)){
            // Elements
            const cookieBar = document.getElementById("mzCookieBar");
            cookieBar.classList.add("active");

            const acceptButton = cookieBar.querySelector(".accept");

            acceptButton.addEventListener("click", function(e){
                setCookie(cookieName, ACCEPTED, "/", expires());
                cookieBar.classList.remove("active");
            });
        }
    })();
</script>
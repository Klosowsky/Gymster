<script>
    /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
    function myFunction() {
        console.log("start");
        document.getElementById("myDropdownMenu").classList.toggle("show-menu");
        console.log("end");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.header-user-details') && !event.target.matches('.user-username') && !event.target.matches('.user-profile-img')) {
            var dropdowns = document.getElementsByClassName("dropdown-menu-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show-menu')) {
                    openDropdown.classList.remove('show-menu');
                }
            }
        }
    }</script>

<div class="trainings-header">
    <div class="header-logo">
        <img class="header-logo-img" src="/public/img/logo.svg">
    </div>


    <div class="header-user-details" onclick="myFunction()">
        <div class="user-username"> ExampleUser123
        </div>
        <div class="user-photo">
            <img class="user-profile-img" src="/public/uploads/Will_Smith.jpg">
        </div>
        <div id="myDropdownMenu" class="dropdown-menu-content">
            <a href="userpanel">Your profile</a>
            <a href="#">Admin panel</a>
            <a href="/logout">Log out</a>
        </div>
    </div>

</div>

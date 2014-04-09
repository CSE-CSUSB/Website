$(".nav-item").click(function (event) {
    $("html, body").scrollTo(this.hash, this.hash);
    event.preventDefault();
});
$('nav a').click(function(e){
    $('html,body').scrollTo(this.hash, this.hash);
    e.preventDefault();
});

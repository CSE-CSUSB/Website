require('git-listener');
var git = new Git({
    port: 443, //Port for webhook 
    branch: 'master', //Branch for clone 
    name: 'Website', //Project and path name  
    clonePath: '/srv/test', //Path where the project will be cloned. Full path let looks like /path/to/name-of 
    repo: 'chid9202@github.com:CSE-CSUSB/Website.git' //SSH clone 
});
 
//Data from stderr and stdout 
git.on('done', function(msg) {
    console.log("git-listener run nicely!");
    console.log(msg);
});
git.on('error', function(error) {
    oonsole.log("it did not run correctly");
    console.log(error);
});


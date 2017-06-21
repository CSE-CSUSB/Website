//index.js
//detail: npmjs.com/package/git-listener
var Git = require('git-listener');

var git = new Git({
	port: 443,	//Port for webhook
	branch: 'master',	//Branch for clone
	name: 'CSE-CSUSB/Website',	//Project and path name
	clonePath: 'home/cse/cse-csusb.org',	//Path where the project will be cloned.
	repo: 'chid9202@github.com:CSE-CSUSB/Website.git'	//SSH clone
});

//Data from stderr and stdout
git.on('done', function(msg) {
	console.log(msg);
})
.on('error', function(error) {
	console.log(error);
});

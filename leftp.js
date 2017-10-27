LEftp = require('le-ftp');

var x = new LEftp({
    "host"		: "buron-joker.de",		// ftp host address, eg. my.server.com
    "port"		: 21,
    "user"		: 'buronq_3',		// Your ftp username
    "password"	: 'aFQ574HsvF2WeMiN',		// Your ftp password

    "watchList":	[
                {
                    "localRootDir"	: "dominix/HolemaClientBundle",
                    "remoteRootDir"	: '/src'
                }
            ],
    // The following two parameters are depricated. Use watchList array instead
    // "localRootDir" : "C:/my/local/folder",	// Depricated, use watchList array instead
    // "remoteRootDir": 'public_html/remote/dir',	// Depricated, use watchList array instead

    "frequency"	: 1,		// Number of seconds between each scan
    "ext"		: ['.css','.js','.html','.html5','txt','jpg','php'],
    "onStartUploadAll"  : false  // On start, upload all files (that match the "watch criteria").
});

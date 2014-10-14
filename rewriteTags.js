#!/usr/bin/env node

var exec = require('child_process').exec;

exec('git log --pretty=format:\'{%n  "commit": "%H",%n  "message": "%s"%n},\' HEAD', function(error, stdout, stderr) {
    var commits = "[";
    commits += stdout +"]";
    commits = commits.replace(/(,])/m, ']');
    commits = JSON.parse(commits);
    for (var i = commits.length - 1; i >= 0; i--) {
        var currentCommit, tag, command;
        currentCommit = commits[i];
        if (!/([^\(]*\([^\)]*)/.test(currentCommit.message)) {
            console.log("Skip "+currentCommit.message+" "+currentCommit.commit);
            continue;
        }
        tag = currentCommit.message;
        tag = tag.replace(/([^\(]*\()/, "");
        tag = tag.replace(/\)/, "");
        command = 'git tag -d '+tag+'; git tag '+tag+" "+currentCommit.commit;
        console.log(command);
        exec(command);
    }
});


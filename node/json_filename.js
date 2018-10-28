require("./config/config");
const path = require("path");

//console.log(`${process.env["MP3_DIRECTORY"]}`);
//const soundFolder = process.env["MP3_DIRECTORY"];
const fs = require("fs");

String.prototype.replaceAll = function(search, replace) {
  if (replace === undefined) {
    return this.toString();
  }
  return this.split(search).join(replace);
};

var obj = {
  files: []
};
const getSoundFileName = val => {
  let soundname = path.parse(val).name;
  soundname = soundname.replaceAll("[Q]", "?").replaceAll("-", " ");

  return soundname;
};

fs.readdirSync(process.env["MP3_DIRECTORY"]).forEach(file => {
  obj.files.push({
    name: getSoundFileName(file),
    artist: "",
    duration: "",
    mp3: file
  });
});

const json = JSON.stringify(obj);
fs.writeFile("myjsonfile.json", json, "utf8", function(err) {
  if (err) {
    throw err;
  }
});

/*
{
  "files": [
    {
      "name": "Ayayayayayayayay!",
      "artist": "",
      "duration": "0:03",
      "mp3": "/sounds/Ayayayayayayayay!.mp3"
    },
*/

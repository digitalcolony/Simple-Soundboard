require("./config/config");
const path = require("path");
const mp3Duration = require("mp3-duration");

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

const getSoundDuration = val => {
  mp3Duration(val, (err, duration) => {
    if (err) {
      throw err;
    }
    console.log(duration);
    //TODO: Not working. Duration is found, but it is not returning.
    return duration.toString();
  });
};

fs.readdirSync(process.env["MP3_DIRECTORY"]).forEach(file => {
  obj.files.push({
    name: getSoundFileName(file),
    artist: "",
    duration: getSoundDuration(process.env["MP3_DIRECTORY"] + file),
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

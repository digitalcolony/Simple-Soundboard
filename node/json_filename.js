require("./config/config");
const path = require("path");
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
    artist: "", // artist is not built with filename version
    mp3: process.env["MP3_DIRECTORY"] + file.toString()
  });
});

const json = JSON.stringify(obj);
fs.writeFile(process.env["JSON_FILENAME"], json, "utf8", function(err) {
  if (err) {
    throw err;
  }
});

var env = process.env.NODE_ENV || "soundboard";

if (env === "soundboard") {
  const config = require("./config.json");
  let envConfig = config[env];

  Object.keys(envConfig).forEach(key => {
    process.env[key] = envConfig[key];
  });
}

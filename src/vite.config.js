import { defineConfig } from "vite";
import path from "path";
import fs from "fs";

// Use the current working directory as the project root
const projectRoot = process.cwd();
const jsDir = path.resolve(projectRoot, "js");

// Dynamically generate input entries for all .js files in the "js" folder
const jsFiles = fs
  .readdirSync(jsDir)
  .filter((file) => path.extname(file) === ".js")
  .reduce((entries, file) => {
    const name = path.parse(file).name;
    entries[name] = path.resolve(jsDir, file);
    return entries;
  }, {});

export default defineConfig({
  root: projectRoot, // Set the project root as the working directory
  build: {
    outDir: path.resolve(projectRoot, "dist"), // Output directory for optimized files
    emptyOutDir: false, // Do not empty the output directory on each build
    rollupOptions: {
      input: jsFiles, // Dynamically generated inputs for all JS files
      output: {
        entryFileNames: "[name].min.js", // Output file naming convention
      },
    },
    watch: {
      include: `${jsDir}/**/*`, // Watch for changes in the "js" folder
    },
  },
});

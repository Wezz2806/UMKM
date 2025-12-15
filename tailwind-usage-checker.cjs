const fs = require('fs');
const path = require('path');

const tailwindPrefixes = [
  'bg-', 'text-', 'font-', 'p-', 'px-', 'py-', 'pt-', 'pr-', 'pb-', 'pl-',
  'm-', 'mx-', 'my-', 'mt-', 'mr-', 'mb-', 'ml-',
  'w-', 'h-', 'min-w-', 'max-w-', 'min-h-', 'max-h-',
  'flex', 'grid', 'col-', 'row-', 'gap-', 'items-', 'justify-', 'content-',
  'rounded', 'shadow', 'border', 'divide-', 'ring-', 'overflow-',
  'z-', 'order-', 'object-', 'hidden', 'block', 'inline', 'visible', 'opacity-', 'transition', 'duration-', 'ease-',
  'hover:', 'focus:', 'active:', 'disabled:', 'group-', 'select-', 'cursor-', 'resize', 'container'
];

const tailwindRegex = new RegExp(
  `\\b(${tailwindPrefixes.join('|')})[\\w\\-:/\\[\\]]*\\b`, 'g'
);

const classAttrRegex = /class\s*=\s*["']([^"']+)["']/g;

function findBladeFiles(dir) {
  let files = [];
  fs.readdirSync(dir).forEach(file => {
    const filepath = path.join(dir, file);
    if (fs.statSync(filepath).isDirectory()) {
      files = files.concat(findBladeFiles(filepath));
    } else if (file.endsWith('.blade.php')) {
      files.push(filepath);
    }
  });
  return files;
}

let totalClassCount = 0;
let tailwindClassCount = 0;
const bladeFiles = findBladeFiles(path.join(__dirname, 'resources', 'views'));

bladeFiles.forEach(file => {
  const content = fs.readFileSync(file, 'utf-8');
  let match;
  while ((match = classAttrRegex.exec(content)) !== null) {
    const classList = match[1].split(/\s+/);
    totalClassCount += classList.length;
    classList.forEach(cls => {
      if (cls.match(tailwindRegex)) tailwindClassCount += 1;
    });
  }
});

const percent = totalClassCount === 0 ? 0 : (tailwindClassCount / totalClassCount * 100).toFixed(2);
console.log(`Jumlah class di Blade: ${totalClassCount}`);
console.log(`Jumlah class Tailwind: ${tailwindClassCount}`);
console.log(`Persentase penggunaan Tailwind di Blade: ${percent}%`);
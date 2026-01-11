# How to Add Theme Screenshot

WordPress themes display a screenshot in the Appearance → Themes admin page. Here's how to add one:

## Option 1: Use Your Live Website (Recommended)

1. Visit your website homepage in a browser
2. Take a full-page screenshot (1200x900px recommended)
3. Save it as `screenshot.png`
4. Upload to the theme root directory: `/wp-content/themes/new-badewatheme/screenshot.png`

**Screenshot Tools:**
- Windows: Use Snipping Tool or Windows + Shift + S
- Mac: Command + Shift + 4
- Browser Extensions: Full Page Screen Capture, Awesome Screenshot
- Online Tools: https://www.screenshotmachine.com/

## Option 2: Convert the SVG Template

I've created a template SVG file (`screenshot-template.svg`) for you. To convert it to PNG:

### Using Online Converter:
1. Go to https://cloudconvert.com/svg-to-png
2. Upload `screenshot-template.svg`
3. Set dimensions to 1200x900
4. Download the PNG
5. Rename to `screenshot.png`
6. Upload to theme directory

### Using ImageMagick (if installed):
```bash
convert screenshot-template.svg -resize 1200x900 screenshot.png
```

### Using Inkscape (if installed):
```bash
inkscape screenshot-template.svg --export-filename=screenshot.png --export-width=1200 --export-height=900
```

## Option 3: Use Photoshop/GIMP

1. Create a new file: 1200x900px
2. Add a screenshot or mockup of your website
3. Save as `screenshot.png`
4. Upload to theme directory

## WordPress Requirements

- **Filename:** Must be exactly `screenshot.png` (lowercase)
- **Location:** Theme root directory
- **Recommended Size:** 1200x900 pixels (4:3 ratio)
- **Format:** PNG (supports transparency)
- **File Size:** Keep under 1MB for performance

## After Adding Screenshot

1. Go to WordPress Admin
2. Navigate to Appearance → Themes
3. You should see your screenshot displayed on the theme tile
4. If not visible, try:
   - Clearing WordPress cache
   - Refreshing the browser (Ctrl+F5 or Cmd+Shift+R)
   - Checking file permissions (644 recommended)

## Quick Tip

The easiest way is to:
1. Activate your theme
2. Visit your homepage
3. Use a browser screenshot tool to capture the page
4. Crop to 1200x900 or similar 4:3 ratio
5. Save as screenshot.png in the theme folder

Your theme will look much more professional in the WordPress admin!

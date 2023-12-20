<?php
function generateRandomColor() {
  $color = '#';
  for ($i = 0; $i < 6; $i++) {
    $color .= dechex(rand(0, 15));
  }
  return $color;
}

function getContrastingTextColor($hexColor) {
  $r = hexdec(substr($hexColor, 1, 2));
  $g = hexdec(substr($hexColor, 3, 2));
  $b = hexdec(substr($hexColor, 5, 2));

  $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;

  return ($luminance > 0.5) ? "#000000" : "#ffffff";
}

$color1 = generateRandomColor();
$color2 = generateRandomColor();
$color3 = generateRandomColor();
$color4 = generateRandomColor();
$color5 = generateRandomColor();

$textColor1 = getContrastingTextColor($color1);
$textColor2 = getContrastingTextColor($color2);
$textColor3 = getContrastingTextColor($color3);
$textColor4 = getContrastingTextColor($color4);
$textColor5 = getContrastingTextColor($color5);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vertical Sections with Unique Colors</title>
  <style>
    body {
      font-family: "Poppins", sans-serif;
      margin: 0;
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      height: 100vh;
    }

    section {
      font-weight: 500;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    section.locked {
      border: 2px solid #ccc;
      pointer-events: none;
    }

    /* Unique colors for each section */
    section:nth-child(1) {
      color: <?php echo $textColor1; ?>;
      background-color: <?php echo $color1; ?>;
    }

    section:nth-child(2) {
      color: <?php echo $textColor2; ?>;
      background-color: <?php echo $color2; ?>;
    }

    section:nth-child(3) {
      color: <?php echo $textColor3; ?>;
      background-color: <?php echo $color3; ?>;
    }

    section:nth-child(4) {
      color: <?php echo $textColor4; ?>;
      background-color: <?php echo $color4; ?>;
    }

    section:nth-child(5) {
      color: <?php echo $textColor5; ?>;
      background-color: <?php echo $color5; ?>;
    }

    .color-box {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-bottom: 10px;
    }

    .copy-text {
      font-size: 14px;
      cursor: pointer;
    }

    .lock-icon {
      font-size: 20px;
      cursor: pointer;
    }
  </style>
</head>
<body>
<section id="color1">
    <div class="color-box"></div>
    <span class="color-code"><?php echo $color1; ?></span>
    <span class="copy-text" onclick="copyToClipboard('color1')">Copy</span>
    <span class="lock-icon" onclick="toggleLock('color1')">🔓</span>
  </section>
  <section id="color2">
    <div class="color-box"></div>
    <span class="color-code"><?php echo $color2; ?></span>
    <span class="copy-text" onclick="copyToClipboard('color2')">Copy</span>
    <span class="lock-icon" onclick="toggleLock('color2')">🔓</span>
  </section>
  <section id="color3">
    <div class="color-box"></div>
    <span class="color-code"><?php echo $color3; ?></span>
    <span class="copy-text" onclick="copyToClipboard('color3')">Copy</span>
    <span class="lock-icon" onclick="toggleLock('color3')">🔓</span>
  </section>
  <section id="color4">
    <div class="color-box"></div>
    <span class="color-code"><?php echo $color4; ?></span>
    <span class="copy-text" onclick="copyToClipboard('color4')">Copy</span>
    <span class="lock-icon" onclick="toggleLock('color4')">🔓</span>
  </section>
  <section id="color5">
    <div class="color-box"></div>
    <span class="color-code"><?php echo $color5; ?></span>
    <span class="copy-text" onclick="copyToClipboard('color5')">Copy</span>
    <span class="lock-icon" onclick="toggleLock('color5')">🔓</span>
  </section>

  <script>
    const colors = {
      color1: { hex: '<?php echo $color1; ?>', locked: false },
      color2: { hex: '<?php echo $color2; ?>', locked: false },
      color3: { hex: '<?php echo $color3; ?>', locked: false },
      color4: { hex: '<?php echo $color4; ?>', locked: false },
      color5: { hex: '<?php echo $color5; ?>', locked: false }
    };

    function generateRandomColor() {
      let color = '#';
      for (let i = 0; i < 6; i++) {
        color += Math.floor(Math.random() * 16).toString(16);
      }
      return color;
    }

    function updateSectionColors(sectionId) {
      const section = document.getElementById(sectionId);
      const colorCodeElement = section.querySelector(".color-code");
      const newColor = generateRandomColor();
      section.style.backgroundColor = newColor;
      colorCodeElement.textContent = newColor;
      colors[sectionId].hex = newColor;
    }

    function copyToClipboard(sectionId) {
      const textArea = document.createElement("textarea");
      textArea.value = colors[sectionId].hex;
      document.body.appendChild(textArea);
      textArea.select();
      document.execCommand("copy");
      document.body.removeChild(textArea);
    }

    function toggleLock(sectionId) {
      const section = document.getElementById(sectionId);
      const lockIcon = section.querySelector(".lock-icon");
      const isLocked = colors[sectionId].locked;
      colors[sectionId].locked = !isLocked;
      lockIcon.textContent = isLocked ? "🔓" : "🔒";
      section.classList.toggle("locked", !isLocked);
    }

    document.addEventListener("keydown", function (event) {
      if (event.key === " ") {
        if (!colors.color1.locked) updateSectionColors("color1");
        if (!colors.color2.locked) updateSectionColors("color2");
        if (!colors.color3.locked) updateSectionColors("color3");
        if (!colors.color4.locked) updateSectionColors("color4");
        if (!colors.color5.locked) updateSectionColors("color5");
      }
    });
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/css/SpeechToText.css">
    <script src="../assets/js/Speech-detection.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/microsoft-cognitiveservices-speech-sdk@latest/distrib/browser/microsoft.cognitiveservices.speech.sdk.bundle.js"></script>
    <title>Text Editor</title>
</head>
<body>
    <div class="page-content">
        <div class="page-title">
            <h2>English - Arabic Speech to Text</h2>
        </div>
        <div class="textArea-container">
            <div class="toolbar">
                <div class="head">
                    <input type="text" placeholder="Filename" value="untitled" id="filename">
                    <select onchange="fileHandle(this.value); this.selectedIndex=0">
                        <option value="" selected hidden disabled>File</option>
                        <option value="new">New file</option>
                        <option value="txt">Save as txt</option>
                        <option value="pdf">Save as pdf</option>
                    </select>
                    <select onchange="formatDoc('formatBlock', this.value); this.selectedIndex=0;">
                        <option value="" selected hidden disabled>Format</option>
                        <option value="h1">Heading 1</option>
                        <option value="h2">Heading 2</option>
                        <option value="h3">Heading 3</option>
                        <option value="h4">Heading 4</option>
                        <option value="h5">Heading 5</option>
                        <option value="h6">Heading 6</option>
                        <option value="p">Paragraph</option>
                    </select>
                    <select onchange="formatDoc('fontSize', this.value); this.selectedIndex=0;">
                        <option value="" selected hidden disabled>Font size</option>
                        <option value="1">Extra small</option>
                        <option value="2">Small</option>
                        <option value="3">Regular</option>
                        <option value="4">Medium</option>
                        <option value="5">Large</option>
                        <option value="6">Extra Large</option>
                        <option value="7">Big</option>
                    </select>
                    <div class="color">
                        <span>Color</span>
                        <input type="color" oninput="formatDoc('foreColor', this.value); this.value='#000000';">
                    </div>
                    <div class="color">
                        <span>Highlight</span>
                        <input type="color" oninput="formatDoc('hiliteColor', this.value); this.value='#000000';">
                    </div>
                    <button id="start-recognition" class="color">Start</button>
                    <button id="stop-recognition" class="color" disabled>Stop</button>
                    <button id="summarize" class="color">summarize</button>
                </div>
                <div class="btn-toolbar">
                    <button onclick="formatDoc('undo')"><i class='bx bx-undo'></i></button>
                    <button onclick="formatDoc('redo')"><i class='bx bx-redo'></i></button>
                    <button onclick="formatDoc('bold')"><i class='bx bx-bold'></i></button>
                    <button onclick="formatDoc('underline')"><i class='bx bx-underline'></i></button>
                    <button onclick="formatDoc('italic')"><i class='bx bx-italic'></i></button>
                    <button onclick="formatDoc('strikeThrough')"><i class='bx bx-strikethrough'></i></button>
                    <button onclick="formatDoc('justifyLeft')"><i class='bx bx-align-left'></i></button>
                    <button onclick="formatDoc('justifyCenter')"><i class='bx bx-align-middle'></i></button>
                    <button onclick="formatDoc('justifyRight')"><i class='bx bx-align-right'></i></button>
                    <button onclick="formatDoc('justifyFull')"><i class='bx bx-align-justify'></i></button>
                    <button onclick="formatDoc('insertOrderedList')"><i class='bx bx-list-ol'></i></button>
                    <button onclick="formatDoc('insertUnorderedList')"><i class='bx bx-list-ul'></i></button>
                    <button onclick="addLink()"><i class='bx bx-link'></i></button>
                    <button onclick="formatDoc('unlink')"><i class='bx bx-unlink'></i></button>
                </div>
            </div>
            <div id="content" contenteditable="true" spellcheck="false"></div>
        </div>
        <div id="summary-section" class="summary-container">
            
        </div>
        <!-- Questions stickyNote -->
        <div class="notes">
        <div class="summary-note">
                <div class="box1">
                    <div class="boxContent">
                        <h3>Summarized notes</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, maiores.</p>
                        <!-- <button>save</button> -->
                    </div>
                </div>
            </div>

            <!-- <div class="questions-note">
                <div class="box">
                    <div class="boxContent">
                        <h3>Questions based on your content</h3>
                        <p>Question 1. <br> Question 2. <br>Question 3</p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assets/js/word-editor.js"></script>
</body>
</html>

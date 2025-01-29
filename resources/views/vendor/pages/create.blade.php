<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advanced Page Builder</title>
  <script src="https://unpkg.com/grapesjs"></script>
  <script src="https://cdn.jsdelivr.net/npm/grapesjs-plugin-export"></script>
  <script src="https://cdn.jsdelivr.net/npm/grapesjs-preset-webpage"></script>
  <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
  <style>
    body, html {
      margin: 0;
      height: 100%;
      font-family: Arial, sans-serif;
    }

    #gjs {
      height: 100vh;
      margin-left: 300px;
      margin-right: 300px;
    }

    .panel__left, .panel__right {
      position: fixed;
      top: 0;
      bottom: 0;
      background: #f5f5f5;
      overflow-y: auto;
      padding: 10px;
      z-index: 10;
    }

    .panel__left {
      width: 300px;
      left: 0;
      border-right: 1px solid #ddd;
    }

    .panel__right {
      width: 300px;
      right: 0;
      border-left: 1px solid #ddd;
    }

    .panel__switcher {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      display: flex;
      justify-content: center;
      background: #ddd;
      padding: 10px;
      z-index: 10;
    }

    .gjs-block {
      cursor: pointer;
    }

    .gjs-block:hover {
      border: 1px dashed #007bff;
    }
  </style>
</head>
<body>
  <div class="panel__left"></div>
  <div id="gjs"></div>
  <div class="panel__right"></div>
  <div class="panel__switcher"></div>

  <script>
    const editor = grapesjs.init({
      container: '#gjs',
      height: '100%',
      width: 'auto',
      storageManager: false,
      fromElement: true,
      plugins: ['grapesjs-preset-webpage', 'grapesjs-plugin-export'],
      pluginsOpts: {
        'grapesjs-preset-webpage': {},
      },
      panels: {
        defaults: [
          {
            id: 'devices',
            buttons: [
              { id: 'desktop', label: 'Desktop', command: 'set-device-desktop', active: true },
              { id: 'tablet', label: 'Tablet', command: 'set-device-tablet' },
              { id: 'mobile', label: 'Mobile', command: 'set-device-mobile' },
            ],
          },
          {
            id: 'options',
            buttons: [
              { id: 'clear', label: 'Clear Canvas', command: 'clear-canvas', className: 'fa fa-trash' },
              { id: 'export', label: 'Export', command: 'export-template', className: 'fa fa-download' },
              { id: 'preview', label: 'Preview', command: 'preview', className: 'fa fa-eye' },
            ],
          },
        ],
      },
      blockManager: {
        appendTo: '.panel__left',
        blocks: [
          // Layouts
          {
            id: 'section',
            label: '<b>Section</b>',
            category: 'Layouts',
            content: `<section style="padding: 20px; background-color: #f5f5f5;">
                        <h1>Section</h1>
                        <p>This is a simple section.</p>
                      </section>`,
          },
          {
            id: 'columns',
            label: '<b>Columns</b>',
            category: 'Layouts',
            content: `<div style="display: flex; gap: 10px;">
                        <div style="flex: 1; padding: 10px; background: #ccc;">Column 1</div>
                        <div style="flex: 1; padding: 10px; background: #ddd;">Column 2</div>
                      </div>`,
          },

          // Basic
          {
            id: 'text',
            label: 'Text',
            category: 'Basic',
            content: '<div data-gjs-type="text">Insert your text here</div>',
          },
          {
            id: 'image',
            label: 'Image',
            category: 'Basic',
            content: { type: 'image' },
          },

          // Typography
          {
            id: 'heading',
            label: 'Heading',
            category: 'Typography',
            content: '<h1>Editable Heading</h1>',
          },
          {
            id: 'paragraph',
            label: 'Paragraph',
            category: 'Typography',
            content: '<p>Editable Paragraph</p>',
          },

          // Media
          {
            id: 'video',
            label: 'Video',
            category: 'Media',
            content: '<video controls></video>',
          },

          // Forms
          {
            id: 'form',
            label: 'Form',
            category: 'Forms',
            content: `<form>
                        <input type="text" placeholder="Your Name" style="margin-bottom: 10px; display: block;" />
                        <button type="submit">Submit</button>
                      </form>`,
          },

          // Buttons
          {
            id: 'button',
            label: 'Button',
            category: 'Buttons',
            content: '<button class="btn">Click me</button>',
          },

          // Advanced
          {
            id: 'raw-html',
            label: 'Raw HTML',
            category: 'Advanced',
            content: '<div>Custom HTML block</div>',
          },
        ],
      },
      styleManager: {
        appendTo: '.panel__right',
        sectors: [
          {
            name: 'General',
            buildProps: [
              'display', 'position', 'top', 'right', 'bottom', 'left', 'margin', 'padding', 'text-align'
            ],
            properties: [
              { name: 'Margin', property: 'margin', type: 'dimensions' },
              { name: 'Padding', property: 'padding', type: 'dimensions' },
              { name: 'Text Align', property: 'text-align', type: 'select', options: [
                { value: 'left', name: 'Left' },
                { value: 'center', name: 'Center' },
                { value: 'right', name: 'Right' },
              ]},
            ],
          },
          {
            name: 'Flex',
            buildProps: ['flex-direction', 'justify-content', 'align-items'],
          },
          {
            name: 'Typography',
            buildProps: ['font-family', 'font-size', 'color', 'line-height'],
          },
          {
            name: 'Decorations',
            buildProps: ['border-radius', 'border', 'box-shadow'],
          },
          {
            name: 'Background',
            buildProps: ['background-color', 'background'],
          },
        ],
      },
    });

    // Clear Canvas Command
    editor.Commands.add('clear-canvas', {
      run(editor) {
        editor.DomComponents.clear();
        editor.CssComposer.clear();
      },
    });

    // Preview Command
    editor.Commands.add('preview', {
      run(editor) {
        editor.stopCommand('sw-visibility');
        editor.getWrapper().getEl().style.pointerEvents = 'none';
        editor.trigger('change:canvasOffset');
      },
      stop(editor) {
        editor.runCommand('sw-visibility');
        editor.getWrapper().getEl().style.pointerEvents = 'auto';
        editor.trigger('change:canvasOffset');
      },
    });

    // Export Template Command
    editor.Commands.add('export-template', {
      run(editor) {
        const html = editor.getHtml();
        const css = editor.getCss();
        const fullContent = `<html><head><style>${css}</style></head><body>${html}</body></html>`;

        const blob = new Blob([fullContent], { type: 'text/html' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'template.html';
        link.click();
      },
    });

    // Set Device Commands
    editor.Commands.add('set-device-desktop', {
      run: (editor) => editor.setDevice('Desktop'),
    });
    editor.Commands.add('set-device-tablet', {
      run: (editor) => editor.setDevice('Tablet'),
    });
    editor.Commands.add('set-device-mobile', {
      run: (editor) => editor.setDevice('Mobile'),
    });
  </script>
</body>
</html>

<template>
    <div>
        <textarea ref="textareaRef"></textarea>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, watch } from 'vue'
import * as JoditModule from 'jodit'
import 'jodit/es2021/jodit.min.css'

const Jodit = JoditModule.Jodit ?? JoditModule.default?.Jodit ?? JoditModule.default

const props = defineProps({
    modelValue: { type: String, default: '' },
    config: { type: Object, default: () => ({}) }
})

const emit = defineEmits(['update:modelValue'])
const textareaRef = ref(null)
let editor = null

// ─── helper: find the closest td/th from a click target ─────────────────────
function closestCell(node) {
    while (node && node.nodeName !== 'TD' && node.nodeName !== 'TH') {
        if (node.classList?.contains('jodit-wysiwyg')) return null
        node = node.parentNode
    }
    return node || null
}

// ─── inject a floating toolbar above the clicked cell ───────────────────────
function attachTablePopup(ed) {
    let floatBar = null

    function removeBar() {
        if (floatBar) { floatBar.remove(); floatBar = null }
    }

    function makeBtn(label, title, onClick) {
        const b = document.createElement('button')
        b.type = 'button'
        b.textContent = label
        b.title = title
        b.style.cssText =
            'font-size:11px;padding:3px 6px;border:1px solid #ccc;' +
            'background:#fff;cursor:pointer;border-radius:3px;white-space:nowrap;'
        b.onmousedown = e => { e.preventDefault(); e.stopPropagation(); onClick(e) }
        return b
    }

    function showBar(cell, table) {
        removeBar()

        floatBar = document.createElement('div')
        floatBar.style.cssText =
            'position:absolute;z-index:99999;background:#f5f5f5;border:1px solid #bbb;' +
            'border-radius:4px;padding:4px 6px;display:flex;flex-wrap:wrap;gap:4px;' +
            'box-shadow:0 2px 6px rgba(0,0,0,.2);'

        const execCmd = (cmd, ...args) => {
            ed.execCommand(cmd, ...args)
            removeBar()
        }

        const buttons = [
            makeBtn('Row ↑', 'Insert row above', () => execCmd('insertRowAbove')),
            makeBtn('Row ↓', 'Insert row below', () => execCmd('insertRowBelow')),
            makeBtn('Col ←', 'Insert col left', () => execCmd('insertColumnBefore')),
            makeBtn('Col →', 'Insert col right', () => execCmd('insertColumnAfter')),
            makeBtn('✕ Row', 'Delete row', () => execCmd('deleteRow')),
            makeBtn('✕ Col', 'Delete column', () => execCmd('deleteColumn')),
            makeBtn('✕ Table', 'Delete table', () => {
                table.remove()
                ed.synchronizeValues()
                removeBar()
            }),
            makeBtn('⬍ Split V', 'Split vertical', () => execCmd('splitv')),
            makeBtn('⬌ Split H', 'Split horizontal', () => execCmd('splith')),
            makeBtn('⊞ Merge', 'Merge cells', () => execCmd('mergecells')),
        ]

        buttons.forEach(b => floatBar.appendChild(b))

        // position above the cell
        const editorRect = ed.container.getBoundingClientRect()
        const cellRect = cell.getBoundingClientRect()
        const top = cellRect.top - editorRect.top + ed.container.scrollTop - 38
        const left = cellRect.left - editorRect.left + ed.container.scrollLeft

        floatBar.style.top = Math.max(2, top) + 'px'
        floatBar.style.left = left + 'px'

        ed.container.style.position = 'relative'
        ed.container.appendChild(floatBar)
    }

    // listen for clicks inside the editor content area
    ed.events.on('click', e => {
        const cell = closestCell(e.target)
        if (cell) {
            const table = cell.closest('table')
            showBar(cell, table)
        } else {
            removeBar()
        }
    })

    // remove bar when editor loses focus
    ed.events.on('blur', removeBar)

    return removeBar // return cleanup fn
}

// ─── main config ─────────────────────────────────────────────────────────────
const defaultConfig = {
    height: 500,
    minHeight: 300,
    readonly: false,
    toolbar: true,
    toolbarAdaptive: false,
    toolbarSticky: true,
    showCharsCounter: true,
    showWordsCounter: true,
    showXPathInStatusbar: false,
    askBeforePasteHTML: false,
    askBeforePasteFromWord: false,
    defaultActionOnPaste: 'insert_clear_html',
    spellcheck: true,
    language: 'en',
    direction: 'ltr',
    enter: 'P',
    tableAllowCellSelection: true,

    buttons: [
        'source', '|',
        'bold', 'italic', 'underline', 'strikethrough', 'eraser', '|',
        'superscript', 'subscript', '|',
        'ul', 'ol', '|',
        'outdent', 'indent', '|',
        'font', 'fontsize', 'brush', 'paragraph', '|',
        'image', 'video', 'table', 'link', 'unlink', '|',
        'align', '|',
        'undo', 'redo', '|',
        'cut', 'copy', 'paste', 'selectall', '|',
        'copyformat', '|',
        'hr', 'symbol', 'fullsize', 'print', 'preview', 'find', '|',
        'lineHeight',
    ],

    // keep only working popup keys (text selection + image + link)
    popup: {
        selection: Jodit.atom([
            'bold', 'italic', 'underline', 'strikethrough', '|',
            'brush', 'font', 'fontsize', '|', 'link',
        ]),
        a: Jodit.atom(['link', 'unlink']),
        img: Jodit.atom(['left', 'center', 'right', 'justify', '|', 'delete']),
    },

    table: {
        allowCellResize: true,
        selectionCellStyle: 'border: 1px double #1e88e5 !important;',
    },
}

let cleanupTablePopup = null

onMounted(() => {
    if (!Jodit) { console.error('Jodit failed to load'); return }

    editor = Jodit.make(textareaRef.value, { ...defaultConfig, ...props.config })
    editor.value = props.modelValue ?? ''
    editor.events.on('change', v => emit('update:modelValue', v))

    // attach the custom table toolbar
    cleanupTablePopup = attachTablePopup(editor)
})

onBeforeUnmount(() => {
    cleanupTablePopup?.()
    if (editor) { editor.destruct(); editor = null }
})

watch(() => props.modelValue, newVal => {
    if (editor && editor.value !== newVal) editor.value = newVal ?? ''
})
</script>

<style>
.jodit-wysiwyg table {
    border-collapse: collapse !important;
    width: 100% !important;
}

.jodit-wysiwyg table td,
.jodit-wysiwyg table th {
    border: 1px solid #ccc !important;
    padding: 6px 10px !important;
    min-width: 40px !important;
}
</style>
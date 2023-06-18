import SunEditor from "suneditor";
import {align, blockquote, fontColor, hiliteColor, list, table, image, video, link} from 'suneditor/src/plugins';
import lang from 'suneditor/src/lang'

document.addEventListener('alpine:init', () => {
    Alpine.data('editor', (el, model) => ({
        value: model,
        init() {
            let parent = this;

            let editor = SunEditor.create(el, {
                value: this.value,
                imageFileInput: false,
                videoFileInput: false,
                landg: "de",
                plugins: [align, blockquote, fontColor, hiliteColor, list, table, link, image, video],
                buttonList: [
                    ['undo', 'redo'],
                    ['bold', 'underline', 'italic', 'strike'],
                    ['fontColor', 'hiliteColor'],
                    ['outdent', 'indent', 'align', 'list', 'horizontalRule'],
                    ['link', 'image', 'video'],
                ],
                lang: document.documentElement.lang == 'en' ? lang.en : lang.de,
            });

            editor.onChange = function (contents) {
                parent.value = contents;
            }
        }
    }))
})
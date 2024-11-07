// buat editor quill
function createQuillEditor(quillElmID, imageHandler) {
    const myToolbar = [
        [{ "header": 1 }, { "header": 2 }, 'bold', 'italic', 'underline', 'strike', 'link'],
        ['blockquote', 'code', 'code-block', { "script": "sub" }, { "script": "super" }],
        ['indent', { "list": "ordered" }, { "list": "bullet" }]

        [{ 'color': [] }, { 'background': [] }],
        [{ 'font': [] }, { 'size': [] }],
        [{ 'align': [] }, { "direction": "rtl" }],

        ['clean'],
        ['image'],
        ['video']
    ];

    const myToolbar1 = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
      
        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction
      
        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
      
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],
      
        ['clean'],                                         // remove formatting button
        ['image'],
        ['video']
    ];

    let quill = new Quill(`#${quillElmID}`, {
        modules: {
            toolbar: {
                container: myToolbar1,
                handlers: {
                    image: imageHandler
                }
            }
        },
        placeholder: 'Tulis content di sini...',
        theme: 'snow'
    });

    return quill;
}

// buat editor quill2
function createQuill2Editor(quillElmID) {
    const myToolbar = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
        ['link', 'image', 'video', 'formula'],
      
        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction
      
        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
      
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],
      
        ['clean']                                         // remove formatting button
    ];

    const quill2 = new Quill(`#${quillElmID}`, {
        modules: {
          toolbar: myToolbar
        },
        theme: 'snow'
    });

    return quill2;
}

// registrasi event on click modal attachment upload.
function registerShowUploadModalOnClick(showButtonID, modalElmID) {
    $(`#${showButtonID}`).click(function () {
        let authModal = new bootstrap.Modal($(`#${modalElmID}`), { backdrop: "static", keyboard: false });
        authModal.show();
    });
}

// registrasi input event untuk tag entry.
function registerTagEntryCharacter(txTags, txaDivTags, entryChar){
    $(`#${txTags}`).on("input", function() {
        var kinput = this.value;
        // console.log(kinput);

        if(kinput.includes(entryChar)) {
            let tagAppend = $(`#${txTags}`).val().slice(0, -1);
            $(`#${txaDivTags}`).append(`<span class="badge bg-${randomizeTagsColor()}">${tagAppend}</span> `);
            $(`#${txTags}`).val("");
        }
    });
}

// registrasi on click event untuk remove tag entry.
function registerTagEntryRemoval(txaDivTags){
    $(`#${txaDivTags}`).on("click", "span.badge", function (e) {
        $(this).remove();
    });
}

// parse tags input
function parseTagsInput(txaTagsElmID, txaDivTagsElmID) {
    document.getElementById(txaTagsElmID).value = "";
    $(`#${txaDivTagsElmID}`).children(`.badge`).each(function () {
        document.getElementById(txaTagsElmID).value += $(this).text() + ",";
    });
}

// load tags input
function loadTagsInput(txaTagsElmID, txaDivTagsElmID) {
    let tags = document.getElementById(txaTagsElmID).value.split(",").filter((item) => {
        return item;
    });

    tags.forEach(function (item, index) {
        $(`#${txaDivTagsElmID}`).append(`<span class="badge bg-${randomizeTagsColor()}">${item}</span> `);
    });
}

// randomisasi warna badge.
function randomizeTagsColor() {
    let colors = [
        "primary",
        "secondary",
        "success",
        "danger",
        "warning",
        "info",
        "dark"
    ];

    const randomColorIndex = Math.floor(Math.random() * colors.length);
    const randomColor = colors[randomColorIndex];
    return randomColor;
}
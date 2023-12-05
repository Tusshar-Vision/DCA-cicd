    var serializedHighlights;
    var highlighter;

    var initialDoc;

    window.onload = function() {
        rangy.init();


        if(localStorage.getItem('serializedData')) {
            serializedHighlights = JSON.parse(localStorage.getItem('serializedData'));
        }

        highlighter = rangy.createHighlighter();

        highlighter.addClassApplier(rangy.createClassApplier("highlight", {
            ignoreWhiteSpace: true,
            tagNames: ["span", "a"]
        }));

        highlighter.addClassApplier(rangy.createClassApplier("note", {
            ignoreWhiteSpace: true,
            elementTagName: "a",
            elementProperties: {
                href: "#",
                onclick: function() {
                    var highlight = highlighter.getHighlightForElement(this);
                    let note = prompt("Add your note");
                    if(note) {
                        let notes = localStorage.getItem("notes");
                        if(notes!=null) {
                            notes = JSON.parse(notes);
                            let isAlreadyNoteForThisHighlight = notes.findIndex((note) => note.id == highlight.id);
                            if(isAlreadyNoteForThisHighlight != -1) {
                                notes[isAlreadyNoteForThisHighlight].notes.push(note);
                            } else  notes.push({id: highlight.id, highlight_text: highlight.getText() ,notes: [note]});
                        } 
                        else{
                            notes = [];
                            notes.push({id: highlight.id, highlight_text: highlight.getText() ,notes: [note]});
                        }
                        
                        localStorage.setItem("notes", JSON.stringify(notes));
                    }



                    // if (window.confirm("Delete this note (ID " + highlight.id + ")?")) {
                    //     highlighter.removeHighlights( [highlight] );
                    // }
                    return false;
                }
            }
        }));


        if (serializedHighlights) {
            highlighter.deserialize(serializedHighlights);
        }
    };


    function highlightSelectedText() {
        highlighter.highlightSelection("highlight");
    }

    function noteSelectedText() {
        highlighter.highlightSelection("note");
    }

    function removeHighlightFromSelectedText() {
        highlighter.unhighlightSelection();
    }

    function highlightScopedSelectedText() {
        highlighter.highlightSelection("highlight", { containerElementId: "summary" });
    }

    function noteScopedSelectedText() {
        highlighter.highlightSelection("note", { containerElementId: "summary" });
    }

    function reloadPage(button) {
        button.form.elements["serializedHighlights"].value = highlighter.serialize();
        button.form.submit();
    }
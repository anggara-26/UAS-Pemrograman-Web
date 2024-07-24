@extends('layouts.admin')

@section('container')
<link rel="stylesheet" href="css/login.css" />
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="css/faq.css" />

<header class="header-container">
  <h1 class="header-title">Hello, Can I Help You?</h1>
  <input
    type="text"
    name="search"
    id="search"
    placeholder="Search..."
    class="search-bar"
  />
  <img src="img/flower_1.svg" alt="bunga" class="flower-1" />
  <img src="img/flower_2.svg" alt="bunga" class="flower-2" />
  <img src="img/flower_3.svg" alt="bunag" class="flower-3" />
</header>

<!-- FAQ Cards -->
<div class="faq">
  <h2 class="faq-title">Frequently Asked Question</h2>
  <div class="faq-card-container" id="faq-card-container">
    <div class="faq-card" id="faq-card">
      <div class="faq-card-header">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
      </div>
      <div class="faq-card-desc">
        <p id="editable-question">
          Pertanyaan yang sering ditanyakan oleh calon penulis yang ingin
        </p>
        <button id="delete">
          <i class="fa-solid fa-trash"></i>
        </button>
        <button id="edit">
          <i class="fa-solid fa-pen-to-square"></i>
        </button>
      </div>
      <div class="faq-answer-admin">
        <p id="editable-answer">
          Jawaban: Lorem ipsum dolor sit amet consectetur adipisicing elit
        </p>
        <button id="save">
          <img src="img/ceklis.png">
        </button>
      </div>
    </div>
  </div>
  <center>
    <button id="add-card-btn" class="add-btn">
      <img src="img/plus.png" alt="">
    </button>
  </center>
</div>

<script>
document.getElementById('delete').addEventListener('click', function() {
  var faqCard = document.getElementById('faq-card');
  if (faqCard) {
    faqCard.remove();
  }
});

document.getElementById("edit").addEventListener("click", function() {
  event.preventDefault();
  var deleteButton = document.getElementById("delete");
  var paragraph = document.getElementById("editable-question");
  var answer = document.getElementById("editable-answer");
  var editButton = document.getElementById("edit");
  var saveButton = document.getElementById("save");
  if (paragraph.contentEditable === "true" || answer.contentEditable === "true") {
    paragraph.contentEditable = "false";
    answer.contentEditable = "false";
    deleteButton.style.display = 'inline-block';
    this.innerHTML = '<i class="fa-solid fa-pen-to-square"></i>';
    saveButton.style.display = 'none';
  } else {
    paragraph.contentEditable = "true";
    answer.contentEditable = "true";
    deleteButton.style.display = 'none';
    editButton.style.display = 'none';
    saveButton.style.display = 'inline-block';
  }
});

document.getElementById("save").addEventListener("click", function(event) {
  event.preventDefault();
  var paragraph = document.getElementById("editable-question");
  var answer = document.getElementById("editable-answer");
  var deleteButton = document.getElementById("delete");
  var editButton = document.getElementById("edit");
  var saveButton = document.getElementById("save");

  paragraph.contentEditable = "false";
  answer.contentEditable = "false";
  deleteButton.style.display = 'inline-block';
  editButton.style.display = 'inline-block';
  saveButton.style.display = 'none';
});

function addCard() {
  fetch('/create-faq', {
    method: 'POST',
    mode: 'no-cors',
    headers: {
      'Content-Type': 'application/json',
      // 'X-CSRF-TOKEN': {{ csrf_token() }}
    },
    body: JSON.stringify({
      question: 'Pertanyaan yang sering ditanyakan oleh calon penulis yang ingin',
      answer: 'Jawaban: Lorem ipsum dolor sit amet consectetur adipisicing elit'
    })
  })
  const cardContainer = document.getElementById('faq-card-container');
  const newCard = document.createElement('div');
  newCard.className = 'faq-card';
  newCard.innerHTML = `
    <div class="faq-card-header">
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
    </div>
    <div class="faq-card-desc">
      <p contenteditable="false" class="editable-question" id="editable-question">
        Pertanyaan yang sering ditanyakan oleh calon penulis yang ingin
      </p>
      <button class="delete" id="delete">
        <i class="fa-solid fa-trash"></i>
      </button>
      <button class="edit" id="edit">
        <i class="fa-solid fa-pen-to-square"></i>
      </button>
    </div>
    <div class="faq-answer-admin" id="faq-answer-admin">
      <p contenteditable="false" class="editable-answer" id="editable-answer">
        Jawaban: Lorem ipsum dolor sit amet consectetur adipisicing elit
      </p>
      <button class="save" id="save">
        <img src="img/ceklis.png" alt="">
      </button>
    </div>
  `;

  cardContainer.appendChild(newCard);
  addCardEventListeners(newCard);
}

function addCardEventListeners(card) {
  const editButton = card.querySelector('.edit');
  const saveButton = card.querySelector('.save');
  const deleteButton = card.querySelector('.delete');
  const questionParagraph = card.querySelector('.editable-question');
  const answerParagraph = card.querySelector('.editable-answer');

  editButton.addEventListener('click', function(event) {
    event.preventDefault();
    if (questionParagraph.contentEditable === "true" || answerParagraph.contentEditable === "true") {
      questionParagraph.contentEditable = "false";
      answerParagraph.contentEditable = "false";
      deleteButton.style.display = 'inline-block';
      editButton.style.display = 'inline-block';
      saveButton.style.display = 'none';
    } else {
      questionParagraph.contentEditable = "true";
      answerParagraph.contentEditable = "true";
      deleteButton.style.display = 'none';
      editButton.style.display = 'none';
      saveButton.style.display = 'inline-block';
    }
  });

  saveButton.addEventListener('click', function(event) {
    event.preventDefault();
    questionParagraph.contentEditable = "false";
    answerParagraph.contentEditable = "false";
    deleteButton.style.display = 'inline-block';
    editButton.style.display = 'inline-block';
    saveButton.style.display = 'none';
  });

  deleteButton.addEventListener('click', function(event) {
    event.preventDefault();
    card.remove();
  });
}

document.getElementById('add-card-btn').addEventListener('click', addCard);
document.getElementById("delete").addCardEventListeners("click", function() {
  event.preventDefault();
  var thisCard = document.getElementById("faq-card");
  thisCard.remove();
});
</script>
@endsection
document.addEventListener("DOMContentLoaded", function() {
    const callAnswersButtons = document.querySelectorAll('.callAnswers');
    let questionId = 0;

    callAnswersButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            questionId = this.dataset.questionid;
            showQuestionAnswers(questionId);
        });
    });

    const sendAnswerButton = document.getElementById('sendAnswerButton');

    if (sendAnswerButton) {
        sendAnswerButton.addEventListener('click', function(e) {
            e.preventDefault();
            sendAnswers(questionId);
        });
    }

    const questions = document.querySelectorAll('.faq-question');

    questions.forEach(question => {
      question.addEventListener('click', function() {
        this.classList.toggle('active');
        let answer = this.nextElementSibling;
        if (answer.style.display === 'block') {
          answer.style.display = 'none';
        } else {
          answer.style.display = 'block';
        }
      });
    });

    let notificationIcon = document.querySelector('.notification-icon');
    let dropdownContent = document.getElementById('notification-content');

    // Abrir/fechar o dropdown de notificações
    notificationIcon.addEventListener('click', function(event) {
        event.stopPropagation();
        fetchNotifications();
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });

    // Fechar o dropdown se clicar fora dele
    window.addEventListener('click', function(event) {
        if (!event.target.matches('.notification-icon')) { 
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            }
        }
    });
});

function showQuestionAnswers(questionId) {
  fetch('/answers/' + questionId)
    .then(response => {
      if (!response.ok) {
        throw new Error('Erro ao obter as respostas');
      }
      return response.json();
    })
    .then(response => {
      const answerList = document.getElementById('answerList');
      answerList.innerHTML = '';

      response.answers.forEach(answer => {
        const listItem = document.createElement('li');
        listItem.className = 'question_id';

        const authorInfoDiv = document.createElement('div');
        authorInfoDiv.className = 'author-info';

        const authorNameElement = document.createElement('span');
        const optionsButton = document.createElement('button');
        optionsButton.className = 'options-button';
        const descriptionElement = document.createElement('span');
        const dateElement = document.createElement('span');
        dateElement.className = 'answerDate';
        const commentsButton = document.createElement('button');
        commentsButton.className = 'comments-button';
        commentsButton.onclick = function () {
          toggleComments(answer.idcontent);
        };
        const voteButton = document.createElement('button');
        voteButton.className = 'vote-button';

        const answerPlus = document.createElement('div');
        answerPlus.className = 'answer-plus';

        authorNameElement.textContent =
          (answer.content.author && answer.content.author.user && answer.content.author.user.name)
            ? answer.content.author.user.name
            : 'undefined';
        descriptionElement.textContent = answer.content.description;
        dateElement.textContent = answer.content.contentdate;

        optionsButton.innerHTML = '<span id="picture" title="Options"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </span>';
        commentsButton.innerHTML = '<span id="picture" title="View Comments"> <i class="fa fa-comments" aria-hidden="true"></i>  </span>';
        voteButton.innerHTML = '<span id="picture" title="Vote"> <i class="fa fa-thumbs-up" aria-hidden="true"></i>  </span>';

        authorNameElement.style.fontWeight = 'bold';
        authorNameElement.style.color = '#064B38';
        descriptionElement.style.color = '#333';
        dateElement.style.fontStyle = 'italic';

        const optionContainer = document.createElement('div');
        optionContainer.className = 'options-container';
        optionContainer.innerHTML = '<button class="options-button" onclick="toggleAnswerOptions(this)"> <span id="picture" title="Options"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span> </button>' +
          '<div class="options-list">' +
          '<a href="#"> <i class="fa fa-info-circle" aria-hidden="true"></i> View Info</a>' +
          '<a href="#" onclick="openEditAnswerForm('+answer.idcontent+')"> <i class="fa fa-magic" aria-hidden="true"></i> Edit Answer</a>' +
          '<a href="#" onclick="confirmDeleteAnswer('+answer.idcontent+')"> <i class="fa fa-trash" aria-hidden="true"></i> Delete Answer</a>' +
          '<a href="#"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Report Answer</a>' +
          '</div>';

        authorInfoDiv.appendChild(authorNameElement);
        authorInfoDiv.appendChild(optionContainer);
        listItem.appendChild(authorInfoDiv);

        listItem.appendChild(descriptionElement);

        answerPlus.appendChild(voteButton);
        answerPlus.appendChild(commentsButton);
        answerPlus.appendChild(dateElement);
        listItem.appendChild(answerPlus);

        const commentsContainer = document.createElement('div');
        commentsContainer.className = 'comments-container'; 
        commentsContainer.id = 'commentsContainer-'+answer.idcontent;

        if(answer.comments) {
          answer.comments.forEach(comment => {
            const commentDiv = document.createElement('div');
            commentDiv.className = 'comment';
            
            commentDiv.innerHTML = '<div id = "author-info">' +
              '<span class="author-name">'+comment.content.author.user.name+'</span>' +
              '<div class="options-container">' +
              '<button class="options-button" onclick="toggleCommentOptions(this)"> <span id="picture" title="Options"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </span></button>' +
              '<div class="options-list" id="optionsList-'+comment.idcontent+'">' +
              '<a href="#"> <i class="fa fa-info-circle" aria-hidden="true"></i> View Info</a>' +
              '<a href="#" onclick="openEditCommentForm('+comment.idcontent+')"> <i class="fa fa-magic" aria-hidden="true"></i> Edit Comment</a>' +
              '<a href="#" onclick="confirmDeleteComment('+comment.idcontent+')"> <i class="fa fa-trash" aria-hidden="true"></i> Delete Comment</a>' +
              '<a href="#"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Report Comment</a>'+
              '</div>' +
              '</div>' +
              '</div>' +
              ' <p class="comment-content">'+comment.content.description+'</p>' +
              '<div id="comment-plus">' +
              '<button class="vote-button" onclick="voteComment('+comment.idcontent+')">' +
              '<span id="picture" title="Vote"> <i class="fa fa-thumbs-up" aria-hidden="true"></i>  </span>' +
              '</button>' +
              '<span id="date">'+comment.content.contentdate+'</span>' +
              '</div>' +
              '</div>';

            commentsContainer.appendChild(commentDiv);
          });
        }
        const typeCommentDiv = document.createElement('div');
        typeCommentDiv.className = 'typeComment';
        typeCommentDiv.innerHTML = '<form id="sendComment">' +
          '<input type="hidden" id="tag_id" name="tag_id" value="{{ $tag->id }}"></input>' +
          '<input type="text" id="comment-answer-description-'+answer.idcontent+'" name="description" placeholder="Write your comment..."></input>' +
          '<button type="submit" id="sendCommentButton" onclick="sendAnswerComment('+answer.idcontent+')">' +
          '<span id="picture" title="Send Comment"> <i class="fa fa-paper-plane" aria-hidden="true"></i> </span>' +
          '</button>' +
          '</form>';
        commentsContainer.appendChild(typeCommentDiv);

        listItem.appendChild(commentsContainer);

        answerList.appendChild(listItem);
      });
    })
    .catch(error => {
      console.error(error.message);
    });
}

function sendAnswers(questionId) {
  const idquestion = questionId;

  const formData = new FormData();
  formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  formData.append('question_id', idquestion);
  formData.append('description', document.getElementById('answer-description').value);
  formData.append('tag_id', document.getElementById('tag_id').value);

  fetch('/answers/create', {
    method: 'POST',
    body: formData
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Erro ao adicionar a resposta');
      }
      return response.json();
    })
    .then(response => {
      console.log(response);
      document.getElementById('answer-description').value = '';
      showQuestionAnswers(idquestion);
    })
    .catch(error => {
      console.error('Ocorreu um erro ao adicionar a resposta:', error);
    });
}

function sendQuestionComment(questionId) {
  const formData = new FormData();
  formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  formData.append('question_id', questionId);
  formData.append('description', document.getElementById('comment-question-description-' + questionId).value);
  formData.append('tag_id', document.getElementById('tag_id').value);

  fetch('/comments/question/create', {
      method: 'POST',
      body: formData,
  })
  .then(response => response.json())
  .then(data => {
      console.log(data);
      document.getElementById('description').value = '';
  })
  .catch(error => {
      console.error('Ocorreu um erro ao adicionar o comentário', error);
  });
}

function sendAnswerComment(answerId) {
  const formData = new FormData();
  formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  formData.append('answer_id', answerId);
  formData.append('description', document.getElementById('comment-answer-description-' + answerId).value);
  formData.append('tag_id', document.getElementById('tag_id').value);

  fetch('/comments/answer/create', {
      method: 'POST',
      body: formData,
  })
  .then(response => response.json())
  .then(data => {
      console.log(data);
      document.getElementById('description').value = '';
  })
  .catch(error => {
      console.error('Ocorreu um erro ao adicionar o comentário', error);
  });
}

function toggleTags(event) {
  event.preventDefault();

  let additionalTags = document.querySelectorAll('.additional-tag');

  additionalTags.forEach(function(tag) {
      tag.style.display = 'list-item';
  });

  // Esconde a opção "Others"
  let othersTag = document.querySelector('.more-tags');
  if (othersTag) {
      othersTag.style.display = 'none';
  }
}

function toggleQuestionOptions(questionId) {
  let optionsList = document.getElementById('optionsList-' + questionId);
  optionsList.style.display = (optionsList.style.display === 'block') ? 'none' : 'block';
}

function toggleAnswerOptions(button) {
  const optionsList = button.nextElementSibling; 
  optionsList.style.display = (optionsList.style.display === 'block') ? 'none' : 'block'; 
}

function toggleCommentOptions(button) {
  const optionsList = button.nextElementSibling; 
  optionsList.style.display = (optionsList.style.display === 'block') ? 'none' : 'block'; 
}

function toggleComments(id) {
  let commentsContainer = document.getElementById('commentsContainer-' + id);

  if (commentsContainer.style.display === 'none' || commentsContainer.style.display === '') {
    commentsContainer.style.display = 'block';
  } else {
      commentsContainer.style.display = 'none';
  }
}

window.onclick = function (event) {
  if (!event.target.matches('.options-button')) {
      let optionsLists = document.querySelectorAll('.options-list');
      optionsLists.forEach(function (optionsList) {
          if (optionsList.style.display === 'block') {
              optionsList.style.display = 'none';
          }
      });
  }
}

function confirmDeleteQuestion(questionId) {
  if (confirm("Are you sure you want to delete this question?")) {
      document.getElementById('delete-question-form-' + questionId).submit();
  }
}

function confirmDeleteAnswer(answerId) {
  if (confirm("Are you sure you want to delete this answer?")) {
      document.getElementById('delete-answer-form-' + answerId).submit();
  }
}

function confirmDeleteComment(commentId) {
  if (confirm("Are you sure you want to delete this comment?")) {
      document.getElementById('delete-comment-form-' + commentId).submit();
  }
}

function openEditAnswerForm(answerId) {
  hideAllEditAnswerForms();
  const form = document.getElementById(`edit-answer-form-${answerId}`);
  
  form.style.display = 'block';
}

function hideAllEditAnswerForms() {
  // Hide all edit answer forms
  const editAnswerForms = document.querySelectorAll('.edit-answer-form');
  editAnswerForms.forEach(form => {
      form.style.display = 'none';
  });
}

function cancelEditAnswer(answerId) {
  const form = document.getElementById(`edit-answer-form-${answerId}`);
  const contentElement = document.getElementById(`answer-content-${answerId}`);
  const editedContentElement = document.getElementById(`edited-content-${answerId}`);

  form.style.display = 'none';
  contentElement.style.display = 'block';

  // Reverte o conteúdo editado para o original
  editedContentElement.value = contentElement.textContent;
}


function editAnswers(answerId, questionId) {
  const form = document.getElementById(`edit-answer-form-${answerId}`);
  const editedContentElement = document.getElementById(`edited-content-${answerId}`);

  const formData = new FormData();
  formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  formData.append('edited_content', editedContentElement.value);
  formData.append('tag_id', document.getElementById('tag_id').value);

  fetch('/answers/' + answerId + '?_method=PUT', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
      console.log('Alterações salvas com sucesso!');
      showQuestionAnswers(questionId);
  })
  .catch(() => {
      console.error('Ocorreu um erro ao salvar as alterações.');
  });

  form.style.display = 'none';
}

function openEditCommentForm(commentId) {
  hideAllEditCommentForms();

  // Show the specific edit comment form
  const editCommentForm = document.getElementById(`edit-comment-form-${commentId}`);
  editCommentForm.style.display = 'block';
}

function hideAllEditCommentForms() {
  // Hide all edit comment forms
  const editCommentForms = document.querySelectorAll('.edit-comment-form');
  editCommentForms.forEach(form => {
      form.style.display = 'none';
  });
}

function cancelEditComment(commentId) {
  const form = document.getElementById(`edit-comment-form-${commentId}`);
  const contentElement = document.getElementById(`comment-content-${commentId}`);
  const editedContentElement = document.getElementById(`edited-content-${commentId}`);

  form.style.display = 'none';
  contentElement.style.display = 'block';

  // Reverte o conteúdo editado para o original
  editedContentElement.value = contentElement.textContent;
}

function editComments(commentId, questionId) {
  const form = document.getElementById(`edit-comment-form-${commentId}`);
  const editedContentElement = document.getElementById(`edited-content-${commentId}`);

  const formData = new FormData();
  formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  formData.append('edited_content', editedContentElement.value);
  formData.append('tag_id', document.getElementById('tag_id').value);

  fetch('/comments/' + commentId + '?_method=PUT', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
      console.log('Alterações salvas com sucesso!');
      showQuestionAnswers(questionId);
  })
  .catch(() => {
      console.error('Ocorreu um erro ao salvar as alterações.');
  });

  form.style.display = 'none';
}

function voteContent(idcontent, iduser) {
  if (iduser === null) {
    alert('You must be logged in to vote!');
    return;
  }

  const formData = new FormData();
  formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  formData.append('content_id', idcontent);
  formData.append('user_id', iduser);

  fetch('/vote/', {
    method: 'POST',
    body: formData,
    headers: {
      'X-Requested-With': 'XMLHttpRequest', 
    }
  })
  .then(response => {
    if (!response.ok) {
        throw new Error('Server responded with a status ' + response.status);
    }
    return response.json();
  })
  .then(data => {
    const voteIcon = document.getElementById('vote-icon-' + idcontent);
    if(data.hasVoted) {
      console.log('Voto acrescentado com sucesso!');
      voteIcon.classList.remove('not-voted');
      voteIcon.classList.add('voted');
    } else {
      console.log('Voto removido com sucesso!');
      voteIcon.classList.remove('voted');
      voteIcon.classList.add('not-voted');
    }
  })
  .catch(error => {
    console.error('Ocorreu um erro ao salvar o voto:', error);
  });
}

// ++++++++++++++++ Notificacoes ++++++++++++++++ //

function fetchNotifications() {
  fetch('/notifications') 
      .then(response => response.json())
      .then(data => {
          displayNotifications(data);
      })
      .catch(error => console.error('Erro ao buscar notificações:', error));
}

function displayNotifications(notifications) {
  notificationContent = document.getElementById('notification-content');
  // Limpar o conteúdo existente
  notificationContent.innerHTML = '';

  // Verificar se existem notificações
  if (notifications.length === 0) {
      notificationContent.innerHTML = '<p>Nenhuma notificação.</p>';
      return;
  }

  // Criar e adicionar notificações ao dropdown
  notifications.forEach(notification => {
      const notificationElement = document.createElement('p');
      notificationElement.textContent = notification.description;
      notificationContent.appendChild(notificationElement);
  });
}

// ++++++++++++++++ Admin ++++++++++++++++
function toggleUserOptions(userId) {
  let optionsList = document.getElementById('optionsList-' + userId);
  optionsList.style.display = (optionsList.style.display === 'block') ? 'none' : 'block';
}

function filterUsers() {
  let input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.querySelector(".view-users table");
  tr = table.getElementsByTagName("tr");

  for (i = 1; i < tr.length; i++) { // Começa em 1 para ignorar o cabeçalho (th)
      let visible = false;
      let tdArray = tr[i].getElementsByTagName("td");

      for (let j = 0; j < tdArray.length; j++) {
          td = tdArray[j];

          if (td) {
              txtValue = td.textContent || td.innerText;

              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  visible = true;
                  break;
              }
          }
      }

      tr[i].style.display = visible ? "" : "none";
  }
}

function resetUsers() {
  let table, tr;

  table = document.querySelector(".view-users table");
  tr = table.getElementsByTagName("tr");

  for (var i = 1; i < tr.length; i++) {
      tr[i].style.display = "";
  }

  document.getElementById("searchInput").value = "";
}

function searchUsers() {
  let searchTerm = document.getElementById('searchInput').value;
  let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

  let xhr = new XMLHttpRequest();
  xhr.open('POST', '/admin/search-user', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
  xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken); 
  xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
          var response = JSON.parse(xhr.responseText);
          displayUserSearchResults(response.users);
      } else {
          console.error('Erro ao realizar a solicitação');
      }
  };
  xhr.send('searchTerm=' + encodeURIComponent(searchTerm));
}

function displayUserSearchResults(users) {
  let searchResults = document.getElementById('searchResults');
  searchResults.innerHTML = ''; // Limpa resultados anteriores
  const linkRedirect = document.getElementById('link-redirect').value;

  if (users.length === 0) {
      searchResults.innerHTML = '<p>No users found.</p>';
      return;
  }

  let table = document.createElement('table');
  table.classList.add('user-table');

  // Cabeçalho da tabela
  let thead = document.createElement('thead');
  let headerRow = document.createElement('tr');
  let headers = ['Name', 'Email'];

  headers.forEach(function (headerText) {
      let th = document.createElement('th');
      th.textContent = headerText;
      headerRow.appendChild(th);
  });

  thead.appendChild(headerRow);
  table.appendChild(thead);

  let tbody = document.createElement('tbody');

  users.forEach(function (user) {
      let tr = document.createElement('tr');

      // Colunas da tabela
      let nameCell = document.createElement('td');
      let nameLink = document.createElement('a');
      nameLink.href = linkRedirect + user.id; // Coloque a rota correta
      nameLink.textContent = user.name;
      nameCell.appendChild(nameLink);

      let emailCell = document.createElement('td');
      emailCell.textContent = user.email;

      tr.appendChild(nameCell);
      tr.appendChild(emailCell);

      tbody.appendChild(tr);
  });

  table.appendChild(tbody);
  searchResults.appendChild(table);
}

function searchTags() {
  let searchTerm = document.getElementById('searchInput').value;
  let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

  let xhr = new XMLHttpRequest();
  xhr.open('POST', '/admin/search-tag', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
  xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken); 
  xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
          var response = JSON.parse(xhr.responseText);
          displayTagSearchResults(response.tags);
      } else {
          console.error('Erro ao realizar a solicitação');
      }
  };
  xhr.send('searchTerm=' + encodeURIComponent(searchTerm));
}

function displayTagSearchResults(tags) {
  let searchResults = document.getElementById('searchResults');
  searchResults.innerHTML = ''; // Limpa resultados anteriores
  const linkRedirect = document.getElementById('link-redirect').value;

  if (tags.length === 0) {
      searchResults.innerHTML = '<p>No tag found.</p>';
      return;
  }

  let table = document.createElement('table');
  table.classList.add('tag-table');

  // Cabeçalho da tabela
  let thead = document.createElement('thead');
  let headerRow = document.createElement('tr');
  let headers = ['ID', 'Description'];

  headers.forEach(function (headerText) {
      let th = document.createElement('th');
      th.textContent = headerText;
      headerRow.appendChild(th);
  });

  thead.appendChild(headerRow);
  table.appendChild(thead);

  let tbody = document.createElement('tbody');

  tags.forEach(function (tag) {
      let tr = document.createElement('tr');

      // Colunas da tabela
      let idCell = document.createElement('td');
      idCell.textContent = tag.id;

      let descriptionCell = document.createElement('td');
      let descriptionLink = document.createElement('a');
      descriptionLink.href = linkRedirect + tag.id; // Coloque a rota correta
      descriptionLink.textContent = tag.description;
      descriptionCell.append(descriptionLink);

      tr.appendChild(idCell);
      tr.appendChild(descriptionCell);

      tbody.appendChild(tr);
  });

  table.appendChild(tbody);
  searchResults.appendChild(table);
}

function resetSearch() {
  document.getElementById('searchInput').value = '';
  document.getElementById('searchResults').innerHTML = '';
}


// ++++++++++++++++ Moderator ++++++++++++++++

function searchTagsModerator() {
  let searchTerm = document.getElementById('searchInput').value;
  let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

  let xhr = new XMLHttpRequest();
  xhr.open('POST', '/moderator/search-tag', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
  xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken); 
  xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
          var response = JSON.parse(xhr.responseText);
          displayTagSearchResults(response.tags);
      } else {
          console.error('Erro ao realizar a solicitação');
      }
  };
  xhr.send('searchTerm=' + encodeURIComponent(searchTerm));
}

function displayTagSearchResults(tags) {
  let searchResults = document.getElementById('searchResults');
  searchResults.innerHTML = ''; // Limpa resultados anteriores
  const linkRedirect = document.getElementById('link-redirect').value;

  if (tags.length === 0) {
      searchResults.innerHTML = '<p>No tag found.</p>';
      return;
  }

  let table = document.createElement('table');
  table.classList.add('tag-table');

  // Cabeçalho da tabela
  let thead = document.createElement('thead');
  let headerRow = document.createElement('tr');
  let headers = ['ID', 'Description'];

  headers.forEach(function (headerText) {
      let th = document.createElement('th');
      th.textContent = headerText;
      headerRow.appendChild(th);
  });

  thead.appendChild(headerRow);
  table.appendChild(thead);

  let tbody = document.createElement('tbody');

  tags.forEach(function (tag) {
      let tr = document.createElement('tr');

      // Colunas da tabela
      let idCell = document.createElement('td');
      idCell.textContent = tag.id;

      let descriptionCell = document.createElement('td');
      let descriptionLink = document.createElement('a');
      descriptionLink.href = linkRedirect + tag.id; // Coloque a rota correta
      descriptionLink.textContent = tag.description;
      descriptionCell.append(descriptionLink);

      tr.appendChild(idCell);
      tr.appendChild(descriptionCell);

      tbody.appendChild(tr);
  });

  table.appendChild(tbody);
  searchResults.appendChild(table);
}

function resetSearch() {
  document.getElementById('searchInput').value = '';
  document.getElementById('searchResults').innerHTML = '';
}


function deleteContent(contentId) {
  var url = `/contents/${contentId}`;

  fetch(url, {
          method: 'DELETE',
          headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              'Content-Type': 'application/json',
          },
      })
      .then(response => {
          if (!response.ok) {
              throw new Error(`HTTP error! Status: ${response.status}`);
          }
          return response.json();
      })
      .then(response => {
        // Check the response for success or error messages
        if (response.success) {
            console.log('Content deleted successfully');
        } else {
            console.error('Content deletion failed:', response.error);
            alert('Content deletion failed. Try again.');
        }
      })
    .catch(error => {
        console.error('Fetch error:', error);
    })
    .finally(() => {
        // update UI
    });; 
}
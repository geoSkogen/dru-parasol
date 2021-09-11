'use strict'

const dominator = {
  word_generator_select : document.querySelector('#sm-syllable-count'),
  param_cap_selectors : [
    document.querySelector('#sm-syllables-cap'),
    document.querySelector('#sm-words-cap'),
    document.querySelector('#sm-phrases-cap'),
  ],
  text_output_box : document.querySelector('#sm-output'),
  /*
  modal : document.querySelector('#modal'),
  buttons : document.querySelectorAll('.fake-button'),
  close_modal : document.querySelector('#close-modal'),
  clipboard : document.querySelector('#clipboard-icon'),
  sections : document.querySelectorAll('.sm-section')
  */
}

const forminator = {
  p_count: 1,
  phrases_cap: 9,
  words_cap: 25,
  syllables_cap: 5,
  content : [],

  get_params : function (nodes) {
    nodes.forEach( (node) => {
      let label = node.getAttribute('name').replace('-','_')
      this[label] = Number(node.value)
    })
  },

  get_random_text : function (nodes) {
    this.get_params(nodes)
    this.content = []
    for (let i = 0; i < this.p_count; i++) {
      this.content.push( paragraph_builder(
        this.phrases_cap,
        this.syllables_cap,
        this.words_cap
      ) )
    }
    return this.content
  }
}
/*
dominator.buttons.forEach( (button) => {
  button.addEventListener('click', function (event) {
    dominator.modal.style.display = 'block'
    dominator.sections[0].style.opacity = '0.15'
    dominator.sections[1].style.opacity = '0.15'
  })
})

dominator.close_modal.addEventListener('click', function (event) {
  dominator.modal.style.display = 'none'
  dominator.sections[0].style.opacity = '1'
  dominator.sections[1].style.opacity = '1'
})
*/
dominator.word_generator_select.addEventListener('click', function (event) {
  dominator.text_output_box.innerHTML = get_random_word(Number(this.value))
})

dominator.param_cap_selectors.forEach( (selector) => {
  selector.addEventListener('click', function (event) {
    let text_arr = forminator.get_random_text(dominator.param_cap_selectors)
    dominator.text_output_box.innerHTML = ''
    text_arr.forEach( (p) => {
      dominator.text_output_box.innerHTML+= "\t\t" + p + "\r\n\r\n"
    })
  })
})
/*
dominator.clipboard.addEventListener('click', function () {
  dominator.text_output_box.select()
  dominator.text_output_box.setSelectionRange(
    0, dominator.text_output_box.value.length
  )
  document.execCommand('copy');
})

window.addEventListener('load', function () {
  document.querySelector('#sm-lorem').appendChild(
    document.createTextNode( get_random_word(2) + ' ' + get_random_word(2) )
  )
})
*/

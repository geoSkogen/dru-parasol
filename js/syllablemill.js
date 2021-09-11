'use strict'

const consonants = ['b','bl','br','c','ch','cl','cr','d','dr','e','f','g','gl',
  'gr','h','i','j','k','kn','l','m','n','o','p','ph','pl','pr','qu','r','s','sh',
  'sl','sr','st','str','t','th','tr','u','v','w','wr','x','y','z'];

const consonants_v = ['','b','rb','c','ch','lc','rc','d','ld','rd','e','f','g',
  'lg','rg','h','i','j','k','ck','nk','l','ll','m','n','o','p','ph','lp','rp',
  'qu','r','s','sh','ls','rs','ts','rts','t','th','rt','u','v','w','wr','x','rx',
  'y','l','z'];

const vowels = ['a','e','i','o','u','y']

function paragraph_builder(phrase_seed,syllable_seed,word_seed) {
  let phrase_count = (isNaN(phrase_seed) || phrase_seed == 0) ? 5 : phrase_seed
  let syllable_count_seed = (isNaN(syllable_seed) || syllable_seed == 0) ? 5 : syllable_seed
  let word_count_seed = (isNaN(word_seed) || word_seed == 0) ? Math.ceil(Math.random()*12) : word_seed
  let int_table = []
  let built_paragraph = ''

  for (let i = 0; i < phrase_count; i++) {
    int_table.push(
      get_random_int_arr(
        word_count_seed,
        syllable_count_seed
      )
    )
  }
  int_table.forEach( (int_arr) => {

    built_paragraph += get_random_phrase(int_arr) + '  '
  })
  return built_paragraph
}


function get_random_int_arr(count_cap, val_cap) {
  let result_arr = []
  // val seed is the max number of syllables per word
  let val_seed = (isNaN(val_cap) || val_cap == 0) ? 5 : val_cap
  // count_seed is the max number of words per phrase if count is not provided
  let count_seed = (isNaN(count_cap) || count_cap == 0) ?  15 : count_cap
  let length = Math.ceil(Math.random()*count_seed)

  for (let i = 0; i < length; i++) {
    result_arr.push(Math.ceil(Math.random()*val_seed))
  }
  return result_arr
}


function get_random_phrase(arr) {
  let built_phrase = ''
  let atom_count = (arr.length) ? arr.length : 1

  for (let i = 0; i < atom_count; i++) {
    //
    let punc = (i === atom_count-1) ? '.' : ' '
    let word =  get_random_word(arr[i])

    word = (i===0) ? word[0].toUpperCase() + word.slice(1,word.length) : word
    built_phrase += word + punc
  }
  return built_phrase
}


function get_random_word(int) {

  let syllable_count = (isNaN(int) || int == 0) ?
    Math.ceil(Math.random()*6) : int

  return word_builder(int)
}


function word_builder(syllable_count) {
  let first_toss
  let second_toss
  let first_choose
  let second_choose
  let inner_switch = 0
  let built_word = ''

  for (let i = 0; i < syllable_count; i++) {
    first_toss = (inner_switch == 1)? 0.25 : Math.random()
    second_toss = Math.random()

    first_choose = (first_toss >= 0.5)?
      Math.floor(Math.random()*vowels.length) :
      Math.floor(Math.random()*consonants.length)
    second_choose = (first_toss >= 0.5 && second_toss < 0.5)?
      Math.floor(Math.random()*consonants.length) :
      Math.floor(Math.random()*vowels.length)

    built_word += (first_toss >= 0.5)? vowels[first_choose] :
      consonants[first_choose];
    built_word += (first_toss >= 0.5 && second_toss < 0.5)?
      consonants_v[second_choose] : vowels[second_choose]

    inner_switch = (first_toss >= 0.5 && second_toss >= 0.5)? 1 : 0
  }
  return built_word
}


//

'use strict'

console.log('this is catalog sam')

const app = {

  field_names : ['title','author','date','label','image'],

  data : { catalog_items: [] },

  list : { dom_nodes: [],

    shuffle: function (data_row) {
      console.log('app.list.shuffle()')
    }
  },

  select : {

    dom_node : document.querySelector('#parasol-catalog-selector'),

    show_item : function (valid_row) {
      //
      let list_item = document.createElement('li')
      let img_tag = document.createElement('img')
      let info_box = document.createElement('div')

      Object.keys(valid_row).forEach( (key) => {

        if (key==='image') {
          img_tag.src = 'modules/dru-parasol/img/' + valid_row[key] + '.jpg'
          //
        } else {
          let content = document.createTextNode(valid_row[key])
          let line = document.createElement('p')
          line.setAttribute('meta',key)
          line.className = 'product-info-line ' + key

          line.appendChild(content)
          info_box.appendChild(line)
        }
      })

      info_box.className = 'product-info-box'
      img_tag.className = 'product-image'

      list_item.appendChild(img_tag)
      list_item.appendChild(info_box)
      list_item.setAttribute('meta',JSON.stringify(valid_row))
      list_item.className = 'catalog-list-item flex-row flex-between'
      list_item.id = valid_row.title

      return list_item
    }

  },

  detail : {

    dom_node: document.querySelector('#parasol-catalog-detail'),
    img_node: document.querySelector('#catalog-detail-image'),
    meta_node: document.querySelector('#product-detail-meta'),
    title_node: document.querySelector('#catalog-detail-title'),

    show : function (data_row) {
      //
      let title_text = document.createTextNode(data_row.title + ' | ' + data_row.author)

      this.meta_node.innerHTML = ''
      this.title_node.innerHTML = ''
      this.img_node.src = 'modules/dru-parasol/img/' + data_row.image + '-detail.jpg'
      this.title_node.appendChild(title_text)

      Object.keys(data_row).forEach( (key) => {

        if (key != 'title' && key != 'author') {
          let el = document.createElement('div')
          let meta_text = document.createTextNode(data_row[key])

          el.setAttribute('meta',key + '-detail')
          el.appendChild(meta_text)
          this.meta_node.appendChild(el)
        }
      })
    }
  },

  init : function (data, reset) {

    data.forEach( (row) => {

      let valid_row = (reset) ? row : this.valid_row(row)
      let list_item = this.select.show_item(valid_row)

      this.list.dom_nodes = []
      this.list.dom_nodes.push( list_item )

      if (!reset) {
        this.data.catalog_items.push( valid_row )
      } else {
        this.select.dom_node.innerHTML = ''
      }

      this.select.dom_node.appendChild(list_item)
    })
  },

  valid_row : function (obj) {
    //
    this.field_names.forEach( (key) => {
      if ( !obj[key] ) {
        obj[key] = (key==='image') ?
          'modules/dru-parasol/img/placeholder.jpg' : '(not set)'
      } // some actual validation here
    })
    return obj
  }
}

// MAIN
window.addEventListener('load', () => {
  xhttp = new XMLHttpRequest();

  xhttp.open("GET", "modules/dru-parasol/js/fake-catalog-api.json", true)
  xhttp.setRequestHeader("Content-Type", "application/json");

  xhttp.onreadystatechange = function() {

    if (this.readyState == 4 && this.status == 200) {

      resp = this.responseText
      console.log(resp)
      // Render the DOM
      app.init( JSON.parse(resp), false)
      // set a placeholder detail view
      app.detail.show( JSON.parse(resp)[0] )
      //
      document.querySelectorAll('.catalog-list-item').forEach( (list_item) => {
        //
        list_item.addEventListener('click', function (event) {
          //
          let data_obj = JSON.parse( this.getAttribute('meta') )

          console.log('list item clicked')
          console.log(data_obj)
          //
          app.list.shuffle( data_obj )
          app.detail.show( data_obj )
        })
      })
    }
  }
  xhttp.send()
})

'use strict'

console.log('this is catalog sam')

const app = {

  field_names : ['title','author','date','label','image'],

  data : { catalog_items: [] },

  list : { dom_nodes: [],

    shuffle: function (data_row) {

      const result_arr = []
      for (let i = Number(data_row.index); i < app.data.catalog_items.length; i++) {
        app.data.catalog_items[i]
        result_arr.push(app.data.catalog_items[i])
        console.log(i)
      }
      for (let i = 0; i < Number(data_row.index); i++) {
        result_arr.push(app.data.catalog_items[i])
        console.log(i)
      }
      console.log("shuffled arr")
      console.log(result_arr)
      app.data.catalog_items = result_arr
    }
  },

  select : {

    dom_node : document.querySelector('#parasol-catalog-selector'),
    scroll_nodes: {
      up: document.querySelector('#product-select-scroll-up') ,
      down: document.querySelector('#product-select-scroll-down')
    },

    scroll : function (arg,json) {
      const row_indices = {
        'up' : app.data.catalog_items.length-1,
        'down' : 1
      }
      const data_row = json ? JSON.parse(json) : JSON.parse(
        document.querySelectorAll('.catalog-list-item')[row_indices[arg]].getAttribute('meta')
      )
      app.list.shuffle(data_row)
      app.init(app.data.catalog_items, true)
      register_app_events(true)
    },

    show_item : function (valid_row, row_index) {
      //
      let list_item = document.createElement('li')
      let anchor_tag = document.createElement('a')
      let img_tag = document.createElement('img')
      let info_box = document.createElement('div')
      let slug = valid_row.title.replace(/\s/g,'-').toLowerCase()

      Object.keys(valid_row).forEach( (key) => {

        if (key==='image') {
          img_tag.src = 'modules/dru-parasol/img/' + valid_row[key] + '.jpg'
          //
        } else {
          if (key!='index') {
            let content = document.createTextNode(valid_row[key])
            let line = document.createElement('p')
            line.setAttribute('meta',key)
            line.className = 'product-info-line ' + key

            line.appendChild(content)
            info_box.appendChild(line)
          }
        }
      })

      info_box.className = 'product-info-box'
      img_tag.className = 'product-image'
      valid_row.index = row_index

      list_item.appendChild(img_tag)
      list_item.appendChild(info_box)
      list_item.setAttribute('meta',JSON.stringify(valid_row))
      list_item.className = 'catalog-list-item flex-row flex-start'

      anchor_tag.className = 'product-nav-anchor'
      anchor_tag.href = '#' + slug
      anchor_tag.appendChild(list_item)

      return anchor_tag
    }

  },

  detail : {

    img_node: document.querySelector('#catalog-detail-image'),
    meta_node: document.querySelector('#product-detail-meta'),
    title_node: document.querySelector('#catalog-detail-title'),

    show : function (data_row) {

      //
      let title_text = document.createTextNode(data_row.title)
      let subtitle_text = document.createTextNode(data_row.author)
      let title_div = document.createElement('div')
      let subtitle_div = document.createElement('div')
      let main_props = ['title','author','image','index']

      title_div.appendChild(title_text)
      subtitle_div.appendChild(subtitle_text)

      this.meta_node.innerHTML = ''
      this.title_node.innerHTML = ''
      this.img_node.src = 'modules/dru-parasol/img/' + data_row.image + '-detail.jpg'

      this.title_node.appendChild(title_div)
      this.title_node.appendChild(subtitle_div)

      Object.keys(data_row).forEach( (key) => {

        if ( main_props.indexOf(key)===-1 ) {
          let el = document.createElement('div')
          let meta_text = document.createTextNode(data_row[key])

          el.className = 'meta-detail'
          el.setAttribute('meta',key + '-detail')
          el.appendChild(meta_text)
          this.meta_node.appendChild(el)
        }
      })
    }
  },

  init : function (data, reset) {

    var i = 0
    this.select.dom_node.innerHTML = ''

    data.forEach( (row) => {

      let valid_row = (reset) ? row : this.valid_row(row)
      let list_item = this.select.show_item( valid_row, i )

      this.list.dom_nodes = []
      this.list.dom_nodes.push( list_item )

      if (!reset) {
        this.data.catalog_items.push( valid_row )
      }

      this.select.dom_node.appendChild(list_item)
      i++
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

function register_app_events(reset) {

  document.querySelectorAll('.catalog-list-item').forEach( (list_item) => {
    //
    list_item.addEventListener('click', function (event) {
      //
      let json_string = this.getAttribute('meta')

      console.log('list item clicked')
      console.log(json_string)
      //
      app.select.scroll(null, json_string)
      app.detail.show( JSON.parse(json_string))
    })
  })

  if (!reset) {
    ['up','down'].forEach( (dir) => {
      app.select.scroll_nodes[dir].addEventListener('click', function () {
        console.log('got scroll node click ' + dir)
        app.select.scroll(dir,null)
      })
    })
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
      //
      // Render the catalog DOM
      app.init( JSON.parse(resp), false)
      //
      // Set a placeholder for the detail view
      app.detail.show( JSON.parse(resp)[0] )
      //
      //
      register_app_events(false)
    }
  }
  xhttp.send()
})

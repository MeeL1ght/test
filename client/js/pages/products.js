// THIS IS A SHIT XD

import {
  isEmpty,
  isValidLength,
  getSanitizedTextFields,
  containsManyWhiteSpaces,
} from '../modules/validations/main.js'

import { sendRequest } from '../modules/http/main.js'

const dom = document

const removeAllButton = dom.querySelector('#remove_all_btn')

// Products List
const productsList = dom.querySelector('#products_list')

// Form
const productForm = dom.querySelector('#product_form')
const productNameField = dom.querySelector('#product_name')

// THIS IS A SHIT
// GET -> Get Products
const getProducts = async () => {
  await sendRequest('./../../server/products').then(res => {
    const products = res.data
    let template = ''

    function span({
      className = '',
      title = '',
      value = '',
    }) {
      const _className = `class="text_product_item ${className}"`
      const _title = `title="${title}"`
      let _value = `${value}`

      if (className.toLowerCase() === 'price')
        _value = `$${value}`

      return `<span ${_className} ${_title}>${_value}</span>`
    }

    products.forEach(product => {
      template += `
      <li
        class="product_item d_flex fd_row align_items_c just_cont_ar"
        data-id="${product.id}"
      >
            ${span({
              className: 'id',
              title: product.id,
              value: product.id,
            })}
            ${span({
              className: 'name',
              title: product.name,
              value: product.name,
            })}
            ${span({
              className: 'price',
              title: product.price,
              value: product.price,
            })}
            <button
              type="button"
              class="btn remove_btn d_flex fd_row align_items_c"
              id="remove_btn"
              title="Remove"
            >
              <ion-icon name="remove-outline" id="remove_icon"></ion-icon>
            </button>
          </li>`
    })

    productsList.innerHTML = template
  })
}

// DELETE -> Remove All Products
removeAllButton.addEventListener('click', async () => {
  const options = { method: 'DELETE' }

  await fetch(`./../../server/products`, options)
  await getProducts()
})

// DELETE -> Remove Product
productsList.addEventListener('click', async e => {
  const typeElement = e.target.parentElement.type
  let element = e.target.parentElement
  let productId = 0

  if (typeElement === '')
    productId = element.getAttribute('data-id')
  else if (typeElement === 'button')
    productId = element.parentElement.getAttribute('data-id')

  const options = { method: 'DELETE' }

  await fetch(`./../../server/product/${productId}`, options)
  await getProducts()
})

// GET -> Get Products
dom.addEventListener('DOMContentLoaded', getProducts)

// POST -> Create Product
productForm.addEventListener('submit', async e => {
  e.preventDefault()

  let textFields = { name: productNameField.value }

  if (!isEmpty(textFields.name)) {
    textFields = getSanitizedTextFields(textFields)

    if (
      isValidLength({
        field: textFields.name,
        min: 1,
        max: 100,
      })
    ) {
      if (!containsManyWhiteSpaces(textFields.name)) {
        const data = new FormData(productForm)
        data.set('product_name', textFields.name)

        const options = {
          method: 'POST',
          body: data,
        }

        await sendRequest('./../../server/product', options)
        await getProducts()

        productForm.reset()
      } else {
        console.log({
          message: 'The field contains many whitespaces',
        })
      }
    } else {
      console.log({
        message: 'Error with field length',
      })
    }
  } else {
    console.log({ message: 'The field is empty' })
  }
})

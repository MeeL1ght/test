/**
 * Is empty field
 * @param {string} value
 * @return {boolean}
 */
const isEmpty = value => value === '' || value === null

/**
 * Is valid length
 * @param {{ field: string, min: number, max: number }}
 * @return {boolean}
 */
function isValidLength({ field, min, max }) {
  return field.length >= min && field.length <= max
}

/**
 * Get new object with the
 * keys and values indicated
 * @param {Array<string>} keys
 * @param {Array<string>} values
 * @return {object}
 */
function getNewObject(keys, values) {
  const newObject = {}

  for (let index = 0; index < keys.length; index++) {
    const key = keys[index]

    newObject[key] = values[index]
  }

  return newObject
}

/**
 * Trim fields | type -> 'text'
 * @param {Array<string>} fields
 * @return {Array<string>}
 */
const trimFields = fields => fields.map(field => field.trim())

/**
 * Get sanitized text fields
 * @param {object} fields
 * @return {object}
 */
function getSanitizedTextFields(fields) {
  const keys = Object.keys(fields)
  const values = Object.values(fields)
  const newObject = getNewObject(keys, trimFields(values))

  return newObject
}

const containsManyWhiteSpaces = word => /\s\s+/g.test(word)

export {
  isEmpty,
  isValidLength,
  getSanitizedTextFields,
  containsManyWhiteSpaces,
}

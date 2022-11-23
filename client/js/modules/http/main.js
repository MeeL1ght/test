/**
 * Send request
 * @param {string} uri
 * @param {object} options
 * @return {Promise<Body>}
 */
async function sendRequest(uri, options = {}) {
  try {
    const res = await fetch(uri, options)
    const jsonData = await res.json()

    return jsonData
  } catch (error) {
    console.error(error)
  }
}

export { sendRequest }

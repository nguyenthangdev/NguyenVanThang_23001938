// Lớp duy nhất giao tiếp với back-end PHP. Lỗi (success = false hoặc mất kết nối) được ném ra dưới dạng Error.
const BASE_URL = '/api/products.php'

async function request(url = BASE_URL, options = {}) {
  let res
  try {
    res = await fetch(url, {
      headers: { 'Content-Type': 'application/json' },
      ...options
    })
  } catch {
    throw new Error('Không kết nối được tới máy chủ.')
  }

  let body
  try {
    body = await res.json()
  } catch {
    throw new Error('Máy chủ trả về dữ liệu không hợp lệ.')
  }
  if (!body.success) throw new Error(body.message || 'Có lỗi xảy ra.')
  return body
}

export const productApi = {
  async list() {
    return (await request()).data
  },
  create(product) {
    return request(BASE_URL, { method: 'POST', body: JSON.stringify(product) })
  },
  update(id, product) {
    return request(`${BASE_URL}?id=${id}`, { method: 'PUT', body: JSON.stringify(product) })
  },
  remove(id) {
    return request(`${BASE_URL}?id=${id}`, { method: 'DELETE' })
  }
}

// Lớp duy nhất giao tiếp với back-end PHP. Lỗi (success = false hoặc mất kết nối) được ném ra dưới dạng Error.
const PRODUCTS_URL = '/api/products.php'
const UPLOAD_URL = '/api/upload.php'

async function request(url, options = {}) {
  let res
  try {
    res = await fetch(url, options)
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

function sendJson(url, method, data) {
  return request(url, {
    method,
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
}

export const productApi = {
  // Trả về { data, pagination }
  list(page, limit) {
    return request(`${PRODUCTS_URL}?page=${page}&limit=${limit}`)
  },
  create(product) {
    return sendJson(PRODUCTS_URL, 'POST', product)
  },
  update(id, product) {
    return sendJson(`${PRODUCTS_URL}?id=${id}`, 'PUT', product)
  },
  remove(id) {
    return request(`${PRODUCTS_URL}?id=${id}`, { method: 'DELETE' })
  },
  // Gửi multipart/form-data; không tự đặt Content-Type để trình duyệt thêm boundary
  uploadImage(id, file) {
    const form = new FormData()
    form.append('id', id)
    form.append('image', file)
    return request(UPLOAD_URL, { method: 'POST', body: form })
  }
}

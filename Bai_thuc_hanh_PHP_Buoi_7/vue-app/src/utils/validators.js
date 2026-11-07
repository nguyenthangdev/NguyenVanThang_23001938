// Mỗi hàm trả về chuỗi lỗi, hoặc '' nếu hợp lệ.
export function validateProduct({ name, price, stock }) {
  if (!name.trim()) return 'Tên không được rỗng.'
  if (price === '' || !(Number(price) > 0)) return 'Giá phải lớn hơn 0.'
  if (stock === '' || !Number.isInteger(Number(stock)) || Number(stock) < 0) {
    return 'Tồn kho phải là số nguyên không âm.'
  }
  return ''
}

export function isValidQuantity(qty, min, max) {
  return Number.isInteger(qty) && qty >= min && qty <= max
}

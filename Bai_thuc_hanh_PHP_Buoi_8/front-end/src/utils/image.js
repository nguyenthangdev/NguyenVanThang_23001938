export const MAX_IMAGE_SIZE = 2 * 1024 * 1024 // 2 MB
export const ACCEPTED_IMAGE_TYPES = ['image/jpeg', 'image/png']

// Kiểm tra sơ bộ ở trình duyệt; PHP vẫn kiểm tra lại loại ảnh thực tế
export function validateImage(file) {
  const extOk = /\.(jpe?g|png)$/i.test(file.name)
  if (!ACCEPTED_IMAGE_TYPES.includes(file.type) || !extOk) {
    return 'Chỉ chấp nhận ảnh JPG, JPEG hoặc PNG.'
  }
  if (file.size > MAX_IMAGE_SIZE) {
    return 'Ảnh vượt quá dung lượng tối đa 2 MB.'
  }
  return ''
}

// Đường dẫn trong cột image (vd: uploads/abc.png) => URL hiển thị
export function imageUrl(path) {
  return path ? `/${path}` : ''
}

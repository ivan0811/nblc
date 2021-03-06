import axios from 'axios'

export default () => {  
    const token = localStorage.getItem('token')
    const axiosInstance = axios.create({        
        baseURL: `/api`,        
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'multipart/form-data'
        }
    })
        

  axiosInstance.interceptors.response.use(
    (response) => response,
    (error) => {
      if (error.response.status === 401) {        
        localStorage.removeItem('token')        
      }
      return Promise.reject(error)
    }
  )

  return axiosInstance
}

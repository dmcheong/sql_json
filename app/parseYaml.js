import { parse } from 'yaml'
import fs from 'fs'

// emplacement du volume
const path = '/var/www/html/data/config.yml'

try {
  const file = fs.readFileSync(path, 'utf8')
  const result = parse(file)
  console.log(JSON.stringify(result))
} catch (err) {
  console.error(`Erreur lecture YML : ${err.message}`)
}

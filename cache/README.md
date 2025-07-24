# PDF Cache Directory

This directory is used for caching PDF generation assets and temporary files to improve performance.

## Structure
- `/pdf_cache/` - Main cache directory for PDF generation
- Cache files are automatically managed by the PDF generation system
- Files older than 24 hours are automatically cleaned up

## Performance Benefits
- Reduces memory pressure during PDF generation
- Improves performance for repeated PDF requests
- Allows for better resource management during peak usage
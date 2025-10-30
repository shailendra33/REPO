<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Create New Idea</h2>
    <form action="index.php?action=store" method="post" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="block mb-2 font-medium">Title</label>
            <input type="text" name="title" required 
                   class="w-full p-3 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        
        <div class="mb-4">
            <label class="block mb-2 font-medium">Description</label>
            <textarea name="description" rows="5" required 
                      class="w-full p-3 bg-gray-800 border border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
        </div>
        
        <div class="mb-6">
            <label class="block mb-2 font-medium">Attachments</label>
            <input type="file" name="attachments[]" multiple 
                   class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
        </div>
        
        <div class="flex space-x-3">
            <button type="submit" 
                    class="bg-primary hover:bg-primary-dark px-6 py-3 rounded transition">
                Save Idea
            </button>
            <a href="index.php" 
               class="bg-gray-700 hover:bg-gray-600 px-6 py-3 rounded transition">
                Cancel
            </a>
        </div>
    </form>
</div>
//testing
